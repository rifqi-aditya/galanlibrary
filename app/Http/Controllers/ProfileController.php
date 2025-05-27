<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\Borrowing;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Milon\Barcode\Facades\DNS1DFacade as DNS1D;



class ProfileController extends Controller
{
    use PasswordValidationRules;

    public function index()
    {
        return view('profile.index', [
            'user' => auth()->user()
        ]);
    }

    public function edit()
    {
        return view('profile.edit', [
            'user' => auth()->user()
        ]);
    }

    public function update(Request $request)
    {
        $input = $request->all();
        $user = User::find(auth()->user()->id);

        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'date_of_birth' => ['required', 'date'],
            'address' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'noHandphone' => ['required', 'string', 'max:30']
        ])->validate();

        $user->forceFill([
            'name' => $input['name'],
            'date_of_birth' => $input['date_of_birth'],
            'address' => $input['address'],
            'email' => $input['email'],
            'noHandphone' => $input['noHandphone']
        ])->save();

        return to_route('profile.index')->with('success', 'Profil berhasil diperbarui');
    }

    public function changePassword()
    {
        return view('profile.change-password');
    }

    public function updatePassword(Request $request)
    {
        $input = $request->all();
        $user = User::find(auth()->user()->id);

        Validator::make($input, [
            'current_password' => ['required'],
            'password' => $this->passwordRules(),
        ])->validate();

        if (Hash::check($request->input('password'), $user->getAuthPassword()) === false) {
            return back()->with('danger', 'Password saat ini yang anda masukkan salah');
        }

        $user->forceFill([
            'password' => Hash::make($input['password']),
        ])->save();

        return to_route('profile.index')->with('success', 'Password berhasil diperbarui');
    }

    public function changePicture(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $input = $request->all();
        Validator::make($input, [
            'picture' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ])->validate();

        $file = $request->file('picture');
        $picture = uniqid() . '.' . $file->getClientOriginalExtension();
        $request->file('picture')->storeAs(User::PICTURE_PATH, $picture);
        if ($user->picture) {
            Storage::delete(User::PICTURE_PATH . '/' . $user->picture);
        }
        $user->picture = $picture;
        $user->save();
        return to_route('profile.index')->with('success', 'Foto berhasil diperbarui');
    }

    public function removePicture(Request $request)
    {
        $userId = auth()->user()->id;
        $user = User::find($userId);

        if ($user->picture) {
            Storage::delete(User::PICTURE_PATH . '/' . $user->picture);
            $user->picture = null;
            $user->save();
            $response = [
                'success' => true,
                'defaultPictureURL' => $user->pictureURL()
            ];
        } else {
            $response = [
                'success' => false
            ];
        }
        response(json_encode($response), 200, [
            'Content-Type:application/json'
        ])->send();
    }



    public function borrowings()
    {
        $user = auth()->user();

        // 1. Belum disetujui oleh admin
        $pendingBorrowings = Borrowing::with('book')
            ->where('user_id', $user->id)
            ->where('status', 'menunggu konfirmasi')
            ->orderBy('created_at', 'DESC')
            ->get();

        // 2. Disetujui dan belum dikembalikan
        $approvedNotReturned = Borrowing::with('book')
            ->where('user_id', $user->id)
            ->where('status', 'disetujui')
            ->where(function ($query) {
                $query->whereNull('return_status')
                    ->orWhere('return_status', '!=', 'sudah dikembalikan');
            })
            ->orderBy('created_at', 'DESC')
            ->get();

        // 3. Disetujui dan sudah dikembalikan
        $approvedReturned = Borrowing::with('book')
            ->where('user_id', $user->id)
            ->where('status', 'disetujui')
            ->where('return_status', 'sudah dikembalikan')
            ->whereNotNull('return_date')
            ->orderBy('created_at', 'DESC')
            ->get();



        return view('profile.borrowings', [
            'pendingBorrowings' => $pendingBorrowings,
            'approvedNotReturned' => $approvedNotReturned,
            'approvedReturned' => $approvedReturned,
        ]);
    }

    public function borrowingDetail(Borrowing $borrowing)
    {
        $borrowing->load('book');

        return view('profile.borrowing-detail', [
            'borrowing' => $borrowing,
        ]);
    }

    public function calculateFine($borrowing)
    {
        $today = Carbon::today();
        $shouldReturnAt = Carbon::parse($borrowing->should_return_at);

        if ($today->greaterThan($shouldReturnAt)) {
            $daysLate = $today->diffInDays($shouldReturnAt);
            return $daysLate * 2000;
        }

        return 0;
    }
}
