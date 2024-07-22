@extends('layouts.main')

@section('main')
    <h3 class="mb-4">Penerbit</h3>
    <div class="mb-3">
        <a href="{{ route('home.index') }}" class="btn btn-sm btn-dark">Home</a>
        @can('create.publishers')
            <a href="{{ route('publisher.create') }}" class="btn btn-sm btn-dark">Tambah Penerbit</a>
        @endcan
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered" id="publisher-table">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Nama Penerbit</th>
                    <th>Alamat</th>
                    <th>Website</th>
                    <th>Jumlah Total Buku</th>
                    @canany(['update.publishers', 'delete.publishers'])
                        <th class="text-center">Actions</th>
                    @endcanany
                </tr>
            </thead>
            <tbody>
                @foreach ($publishers as $index => $publisher)
                    <tr>
                        <td>{{ ++$index }}</td>
                        <td>{{ $publisher->name }}</td>
                        <td>{{ $publisher->address }}</td>
                        <td>
                            <a href="{{ $publisher->website }}" target="_blank">{{ $publisher->website }}</a>
                        </td>
                        <td>{{ $publisher->books->sum('stock') }}</td>
                        @canany(['update.publishers', 'delete.publishers'])
                            <td nowrap class="text-center">
                                @can('update.publishers')
                                    <a href="{{ route('publisher.edit', ['publisher' => $publisher]) }}"
                                        class="btn btn-outline-success btn-sm">
                                        <i class="material-icons">edit</i>
                                    </a>
                                @endcan
                                @can('delete.publishers')
                                    <form action="{{ route('publisher.destroy', ['publisher' => $publisher]) }}" method="post"
                                        class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button onclick="return confirm('Hapus penerbit: {{ $publisher->name }} ?')"
                                            type="submit" class="btn btn-outline-danger btn-sm">
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
@endsection
