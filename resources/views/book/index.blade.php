@extends('layouts.main')

@section('main')
 <div >
       <h3 class="mb-4">Buku</h3>
    <div class="mb-3">
        <a href="{{ route('home.index') }}" class="btn btn-sm btn-dark">Home</a>
        @can('create.books')
            <a href="{{ route('book.create') }}" class="btn btn-sm btn-dark">Tambah Buku</a>
        @endcan
    </div>
    <div class="table-responsive" style="margin-top: 30px; ">
        <table class="table table-striped table-hover table-bordered" id="book-table">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Judul</th>
                    <th>Pengarang</th>
                    <th>Penerbit</th>
                    <th>Tahun Terbit</th>
                    <th>Jumlah Buku</th>
                    <th>Kategori</th>
                    @canany(['update.books', 'delete.books'])
                        <th class="text-center">Actions</th>
                    @endcanany
                </tr>
            </thead>
            <tbody>
                @foreach ($books as $index => $book)
                    <tr>
                        <td style="width: 30px;">{{ ++$index }}</td>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->publisher->name }}</td>
                        <td>{{ $book->publication_year }}</td>
                        <td>{{ $book->stock }}</td>
                        <td>{{ $book->category->name }}</td>
                        @canany(['update.books', 'delete.books'])
                            <td class="text-center">
                                <a href="{{ route('book.show', ['book' => $book]) }}"
                                    class="btn btn-outline-primary btn-sm">
                                    <i class="material-icons">visibility</i>
                                </a>
                                @can('delete.books')
                                    <form action="{{ route('book.destroy', ['book' => $book]) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button onclick="return confirm('Hapus buku: {{ $book->title }} ?')" type="submit"
                                            class="btn btn-outline-danger btn-sm">
                                            <i class="material-icons">delete_forever</i>
                                        </button>
                                    </form>
                                @endcan
                            </td>
                        @endcanany
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
 </div>
@endsection
