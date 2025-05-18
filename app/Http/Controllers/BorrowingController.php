<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class BorrowingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // Skripsi

    public function stores(Request $request)
    {

        // Log::info('Data request:', $request->all());

        // dd($request->all());


        $request->validate([
            'book_id' => 'required|exists:books,id',

        ]);



        Borrowing::create([
            'user_id' => auth()->id(),
            'book_id' => $request->book_id,
            'number_of_books' => 1,
            'should_return_at' => now()->addDays(7)->toDateString(),
            'status' => 'menunggu konfirmasi',
        ]);

        return redirect()->back()->with('success', 'Permintaan peminjaman berhasil dikirim.');
    }





    // end skripsi




    public function index()
    {
        $activeBorrowings = Borrowing::with(['user', 'book'])->where('return_date', '=', null)->orderBy('created_at', 'DESC')->get();
        $returnedBorrowings = Borrowing::with(['user', 'book'])->where('return_date', '!=', null)->orderBy('return_date', 'DESC')->get();

        foreach ($activeBorrowings as $borrowing) {
            $borrowing->fine = $this->calculateFine($borrowing);
            $borrowing->save();
        }

        return view('borrowing.index', [
            'activeBorrowings' => $activeBorrowings,
            'returnedBorrowings' => $returnedBorrowings,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::role('member')->orderBy('name', 'ASC')->get();
        $books = Book::with('publisher')->orderBy('title', 'ASC')->get();
        return view('borrowing.create', [
            'users' => $users,
            'books' => $books,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        Validator::make($input, [
            'user_id' => ['required', 'integer'],
            'book_id' => ['required', 'integer'],
            'should_return_at' => ['required', 'date'],
        ])->validate();

        $book = Book::findOrFail($input['book_id']);

        Validator::make($input, [
            'number_of_books' => ['required', 'numeric', 'min:1', "max:$book->stock"],
        ])->validate();

        Borrowing::create([
            'user_id' => $input['user_id'],
            'book_id' => $input['book_id'],
            'number_of_books' => $input['number_of_books'],
            'should_return_at' => $input['should_return_at'],
        ]);

        $book->forceFill([
            'stock' => $book->stock - $input['number_of_books']
        ])->save();

        return to_route('borrowing.index')->with('success', 'Peminjaman berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Borrowing  $borrowing
     * @return \Illuminate\Http\Response
     */
    public function show(Borrowing $borrowing)
    {
        $borrowing->load(['user', 'book']);

        return view('borrowing.show', [
            'borrowing' => $borrowing,
        ]);
    }

    public function showByUser(User $user)
    {
        $user->load('borrowings');
        return view('borrowing.show-by-user', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Borrowing  $borrowing
     * @return \Illuminate\Http\Response
     */
    public function edit(Borrowing $borrowing)
    {
        if ($borrowing->return_date) {
            abort(404);
        }

        $borrowing->load(['user', 'book']);

        $users = User::role('member')->orderBy('name', 'ASC')->get();
        $books = Book::with('publisher')->orderBy('title', 'ASC')->get();
        return view('borrowing.edit', [
            'users' => $users,
            'books' => $books,
            'borrowing' => $borrowing
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Borrowing  $borrowing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Borrowing $borrowing)
    {
        if ($borrowing->return_date) {
            abort(404);
        }

        $input = $request->all();

        Validator::make($input, [
            'user_id' => ['required', 'integer'],
            'book_id' => ['required', 'integer'],
            'should_return_at' => ['required', 'date'],
        ])->validate();

        $book = Book::findOrFail($input['book_id']);

        $bookStock = $book->stock + $borrowing->number_of_books;

        Validator::make($input, [
            'number_of_books' => ['required', 'numeric', 'min:1', "max:$bookStock"],
        ])->validate();

        $oldNumberOfBooks = $borrowing->number_of_books;
        $newNumberOfBooks = $input['number_of_books'];
        $newStock = $book->stock;

        if ($oldNumberOfBooks > $newNumberOfBooks) {
            $decrement = $input['number_of_books'] - $borrowing->number_of_books;
            $newStock = $book->stock - $decrement;
        } elseif ($oldNumberOfBooks < $newNumberOfBooks) {
            $increment = $borrowing->number_of_books - $input['number_of_books'];
            $newStock = $book->stock + $increment;
        } else {
            $newStock = $book->stock;
        }
        $book->stock = $newStock;
        $book->save();

        $borrowing->user_id = $input['user_id'];
        $borrowing->book_id = $input['book_id'];
        $borrowing->number_of_books = $input['number_of_books'];
        $borrowing->should_return_at = $input['should_return_at'];
        $borrowing->save();

        if ($borrowing->number_of_books != $input['number_of_books']) {
            if ($input['number_of_books'] > $borrowing->number_of_books) {
                $newStock = $book->stock - ($input['number_of_books'] - $borrowing->number_of_books);
            } else {
                $newStock = $book->stock + ($borrowing->number_of_books - $input['number_of_books']);
            }

            return $newStock;
        }

        return to_route('borrowing.show', ['borrowing' => $borrowing])->with('success', 'Terima kasih, Peminjaman Buku ' . $borrowing->book->title . ' berhasil ditandai diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Borrowing  $borrowing
     * @return \Illuminate\Http\Response
     */
    public function destroy(Borrowing $borrowing)
    {
        //
    }

    public function return(Request $request, Borrowing $borrowing)
    {
        $borrowing->load('book');
        if ($borrowing->return_date) {
            abort(404);
        }

        $returnDate = date('Y-m-d');
        if ($returnDate < $borrowing->should_return_at->format('Y-m-d')) {
            $returnStatus = 'Lebih Awal';
        } elseif ($returnDate == $borrowing->should_return_at->format('Y-m-d')) {
            $returnStatus = 'Tepat Waktu';
        } else {
            $returnStatus = 'Terlambat';
        }

        $borrowing->forceFill([
            'return_date' => date('Y-m-d'),
            'return_status' => $returnStatus,
        ])->save();

        $borrowing->book->forceFill([
            'stock' => $borrowing->book->stock + $borrowing->number_of_books
        ])->save();

        $input = $request->all();
        if (isset($input['redirect-to'])) {
            return redirect($input['redirect-to'])->with('success', 'Terima kasih, Buku ' . $borrowing->book->title . ' berhasil ditandai sudah dikembalikan.');
        }
        return to_route('borrowing.index')->with('success', 'Terima kasih, Buku ' . $borrowing->book->title . ' berhasil ditandai sudah dikembalikan.');
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
