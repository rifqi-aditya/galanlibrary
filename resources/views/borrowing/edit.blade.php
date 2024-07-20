@extends('layouts.main')

@section('main')
    <h3 class="mb-4">Edit Peminjaman Buku</h3>
    <form action="{{ route('borrowing.update', ['borrowing' => $borrowing]) }}" method="post">
        @csrf
        @method('put')
        <div class="mb-3">
            <label for="user_id" class="form-label">Nama Peminjam</label>
            <br>
            <select name="user_id" id="user_id" class="form-control select2">
                @foreach ($users as $user)
                    <option {{ old('user_id', $borrowing->user_id) == $user->id ? 'selected' : '' }}
                        value="{{ $user->id }}">{{ $user->name }} -- {{ $user->nis }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="book_id" class="form-label">Buku Yang Dipinjam</label>
            <br>
            <select name="book_id" id="book_id" class="form-control select2">
                @foreach ($books as $book)
                    <option {{ old('book_id', $borrowing->book_id) == $book->id ? 'selected' : '' }}
                        value="{{ $book->id }}">
                        {{ $book->title }} (tersedia:
                        {{ $borrowing->book_id == $book->id ? $book->stock + $borrowing->number_of_books : $book->stock }})
                        -- {{ $book->publisher->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="number_of_books" class="form-label">Jumlah Dipinjam</label>
            <input type="number" min="1" class="form-control" name="number_of_books" id="number_of_books"
                value="{{ old('number_of_books', $borrowing->number_of_books) }}">
        </div>
        <div class="mb-3">
            <label for="should_return_at" class="form-label">Tanggal Pengembalian</label>
            <input type="date" class="form-control" name="should_return_at" id="should_return_at"
                value="{{ old('should_return_at', $borrowing->should_return_at->format('Y-m-d')) }}">
        </div>
        <div>
            <a href="{{ route('borrowing.index') }}" class="btn btn-sm btn-outline-dark">Batal</a>
            <button type="submit" class="btn btn-dark btn-sm">Simpan</button>
        </div>
    </form>
@endsection
