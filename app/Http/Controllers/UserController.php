<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\PasswordValidationRules;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    use PasswordValidationRules;

    public function index()
    {
        return view('user.index', [
            'users' => User::with('roles')->orderBy('created_at', 'desc')->get()
        ]);
    }

    public function create()
    {
        return view('user.create', [
            'roles' => Role::all()
        ]);
    }

    public function store(Request $request)
    {
        $input = $request->all();

        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'date_of_birth' => ['required', 'date'],
            'address' => ['required', 'string', 'max:255'],
            'picture' => ['image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
        ])->validate();

        $picture = null;
        if ($request->hasFile('picture')) {
            $file = $request->file('picture');
            $picture = uniqid() . '.' . $file->getClientOriginalExtension();
            $request->file('picture')->storeAs(User::PICTURE_PATH, $picture);
        }

        $user = User::create([
            'name' => $input['name'],
            'date_of_birth' => $input['date_of_birth'],
            'address' => $input['address'],
            'picture' => $picture,
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);

        if (isset($input['roles'])) {
            foreach ($input['roles'] as $role) {
                if (Role::findByName($role)) {
                    $user->assignRole($role);
                }
            }
        }

        return to_route('user.index')->with('success', 'Akun berhasil dibuat.');
    }

    public function show(User $user)
    {
        $user->load('borrowings');

        return view('user.show', [
            'user' => $user
        ]);
    }

    public function edit(User $user)
    {
        return view('user.edit', [
            'user' => $user,
            'roles' => Role::all()
        ]);
    }

    public function update(Request $request, User $user)
    {
        $input = $request->all();

        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'date_of_birth' => ['required', 'date'],
            'address' => ['required', 'string', 'max:255'],
            'picture' => ['image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
        ])->validate();

        if (isset($input['password'])) {
            Validator::make($input, [
                'password' => $this->passwordRules()
            ])->validate();

            $user->forceFill([
                'password' => Hash::make($input['password'])
            ])->save();
        }

        $picture = $user->picture;

        if (isset($input['use_gravatar'])) {
            if ($user->picture) {
                Storage::delete(User::PICTURE_PATH . '/' . $user->picture);
                $picture = null;
            }
        } else {
            if ($request->hasFile('picture')) {
                $file = $request->file('picture');
                $picture = uniqid() . '.' . $file->getClientOriginalExtension();
                $request->file('picture')->storeAs(User::PICTURE_PATH, $picture);
                if ($user->picture) {
                    Storage::delete(User::PICTURE_PATH . '/' . $user->picture);
                }
            }
        }

        $user->forceFill([
            'name' => $input['name'],
            'date_of_birth' => $input['date_of_birth'],
            'address' => $input['address'],
            'picture' => $picture,
            'email' => $input['email'],
        ])->save();

        if (isset($input['roles'])) {
            $roles = [];
            foreach ($input['roles'] as $role) {
                if (Role::findByName($role)) {
                    array_push($roles, $role);
                }
            }
        } else {
            $roles = [];
        }

        $user->syncRoles($roles);

        return to_route('user.index')->with('success', 'Akun berhasil diperbarui');
    }

    public function delete(User $user)
    {
        $authenticated = auth()->user();
        if ($authenticated->id == $user->id) {
            return to_route('user.index')->with('warning', 'Tidak dapat menghapus akun <b>' . $user->name . '</b>, anda sedang login dengan akun ini.');
        }

        return view('user.delete', [
            'user' => $user
        ]);
    }

    public function destroy(Request $request, User $user)
    {
        $authenticated = auth()->user();

        Validator::make($request->all(), [
            'password' => ['required']
        ])->validate();

        if (Hash::check($request->input('password'), $authenticated->getAuthPassword()) === false) {
            return back()->with('danger', 'Konfirmasi gagal, password salah.');
        }

        User::destroy($user->id);

        return to_route('user.index')->with('success', 'Akun berhasil dihapus');
    }
}
