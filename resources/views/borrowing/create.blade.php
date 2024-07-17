@extends('layouts.main')

@section('main')
    <h3 class="mb-4">Tambah Peminjaman Buku</h3>
    <form action="{{ route('borrowing.store') }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="user_id" class="form-label">Nama Peminjam</label>
            <br>
            <select name="user_id" id="user_id" class="form-control select2">
                @foreach ($users as $user)
                    <option {{ old('user_id') == $user->id ? 'selected' : '' }} value="{{ $user->id }}">
                        {{ $user->name }} -- {{ $user->nis }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="book_id" class="form-label">Buku Yang Dipinjam</label>
            <br>
            <select name="book_id" id="book_id" class="form-control select2">
                @foreach ($books as $book)
                    <option {{ old('book_id') == $book->id ? 'selected' : '' }} value="{{ $book->id }}">
                        {{ $book->title }} (tersedia: {{ $book->stock }}) -- {{ $book->publisher->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="mb-3">
                    <label for="number_of_books" class="form-label">Jumlah Dipinjam</label>
                    <input type="number" min="1" class="form-control" name="number_of_books" id="number_of_books"
                        value="{{ old('number_of_books') }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="mb-3">
                    <label for="should_return_at" class="form-label">Batas Pengembalian</label>
                    <input type="date" class="form-control" name="should_return_at" id="should_return_at"
                        value="{{ old('should_return_at') }}">
                </div>
            </div>
        </div>
        <div>
            <a href="{{ route('borrowing.index') }}" class="btn btn-sm btn-outline-dark">Batal</a>
            <button type="submit" class="btn btn-dark btn-sm">Simpan</button>
        </div>
    </form>
@endsection
