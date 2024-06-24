<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('book.index', [
            'books' => Book::with(['publisher', 'category'])->orderBy('created_at', 'DESC')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('book.create', [
            'publishers' => Publisher::orderBy('created_at', 'DESC')->get(),
            'categories' => Category::orderBy('created_at', 'DESC')->get(),
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
            'title' => ['required', 'string', 'max:128'],
            'description' => ['string', 'max:200'],
            'author' => ['required', 'string', 'max:120'],
            'publisher_id' => ['required', 'numeric'],
            'publication_year' => ['required', 'date_format:Y'],
            'stock' => ['required', 'numeric', 'min:1'],
            'category_id' => ['required', 'numeric'],
            'cover' => ['image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ])->validate();

        $cover = null;
        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $cover = uniqid() . '.' . $file->getClientOriginalExtension();
            $request->file('cover')->storeAs(Book::COVER_PATH, $cover);
        }

        Book::create([
            'title' => $input['title'],
            'description' => $input['description'],
            'author' => $input['author'],
            'publisher_id' => $input['publisher_id'],
            'publication_year' => $input['publication_year'],
            'stock' => $input['stock'],
            'category_id' => $input['category_id'],
            'cover' => $cover,
        ]);

        return to_route('book.index')->with('success', 'Buku berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        $book->load(['category', 'publisher']);
        return view('book.show', [
            'book' => $book
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        return view('book.edit', [
            'book' => $book,
            'publishers' => Publisher::orderBy('created_at', 'DESC')->get(),
            'categories' => Category::orderBy('created_at', 'DESC')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $input = $request->all();

        Validator::make($input, [
            'title' => ['required', 'string', 'max:128'],
            'description' => ['string', 'max:200'],
            'author' => ['required', 'string', 'max:120'],
            'publisher_id' => ['required', 'numeric'],
            'publication_year' => ['required', 'date_format:Y'],
            'stock' => ['required', 'numeric', 'min:1'],
            'category_id' => ['required', 'numeric'],
            'cover' => ['image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ])->validate();

        $cover = $book->cover;

        if ($request->hasFile('cover')) {
            if ($cover) {
                Storage::delete(Book::COVER_PATH . '/' . $cover);
            }
            $file = $request->file('cover');
            $cover = uniqid() . '.' . $file->getClientOriginalExtension();
            $request->file('cover')->storeAs(Book::COVER_PATH, $cover);
        }

        $book->forceFill([
            'title' => $input['title'],
            'description' => $input['description'],
            'author' => $input['author'],
            'publisher_id' => $input['publisher_id'],
            'publication_year' => $input['publication_year'],
            'stock' => $input['stock'],
            'category_id' => $input['category_id'],
            'cover' => $cover,
        ])->save();

        return to_route('book.show', ['book' => $book])->with('success', 'Buku berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        Book::destroy($book->id);
        return to_route('book.index')->with('success', 'Buku berhasil dihapus');
    }
}
