@extends('layouts.main')

@section('main')
    <h3 class="mb-4">Kategori Buku</h3>
    <div class="mb-3">
        <a href="{{ route('home.index') }}" class="btn btn-sm btn-dark">Home</a>
        @can('create.categories')
            <a href="{{ route('category.create') }}" class="btn btn-sm btn-dark">Buat Kategori</a>
        @endcan
    </div>
    <div class="table-responsive">
        <table class="table table-bordered" id="category-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Kategori</th>
                    <th>Jumlah Data Buku</th>
                    <th>Keterangan</th>
                    @canany(['update.categories', 'delete.categories'])
                        <th class="text-center">Actions</th>
                    @endcanany
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $index => $category)
                    <tr>
                        <td>{{ ++$index }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->books->sum('stock') }}</td>
                        <td>{{ $category->description }}</td>
                        @canany(['update.categories', 'delete.categories'])
                            <td class="text-center">
                                @can('update.categories')
                                    <a href="{{ route('category.edit', ['category' => $category]) }}"
                                        class="link-success material-icons text-decoration-none">
                                        edit
                                    </a>
                                @endcan
                                @can('delete.categories')
                                    <form action="{{ route('category.destroy', ['category' => $category]) }}" method="post"
                                        class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button onclick="return confirm('Hapus kategori: {{ $category->name }} ?')" type="submit"
                                            class="border-0 bg-transparent material-icons text-decoration-none link-danger">delete_forever</button>
                                    </form>
                                @endcan
                            </td>
                        @endcanany
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
