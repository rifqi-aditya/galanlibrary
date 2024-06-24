@extends('layouts.main')

@section('main')
    <h3 class="mb-4">Rak Buku</h3>
    <div class="mb-3">
        <a href="{{ route('home.index') }}" class="btn btn-sm btn-dark">Home</a>
        @can('create.racks')
            <a href="{{ route('rack.create') }}" class="btn btn-sm btn-dark">Tambah Rak Buku</a>
        @endcan
    </div>
    <div class="table-responsive">
        <table class="table table-bordered" id="rack-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Kode</th>
                    <th>Keterangan</th>
                    <th>Kategori</th>
                    @canany(['update.racks', 'delete.racks'])
                        <th class="text-center">Actions</th>
                    @endcanany
                </tr>
            </thead>
            <tbody>
                @foreach ($racks as $index => $rack)
                    <tr>
                        <td>{{ ++$index }}</td>
                        <td>{{ $rack->code }}</td>
                        <td>{{ $rack->description }}</td>
                        <td>
                            @forelse ($rack->categories as $category)
                                <li>{{ $category->name }}</li>
                            @empty
                                Tidak Ada
                            @endforelse
                        </td>
                        @canany(['update.racks', 'delete.racks'])
                            <td class="text-center">
                                @can('update.racks')
                                    <a href="{{ route('rack.edit', ['rack' => $rack]) }}"
                                        class="link-success material-icons text-decoration-none">
                                        edit
                                    </a>
                                @endcan
                                @can('delete.racks')
                                    <form action="{{ route('rack.destroy', ['rack' => $rack]) }}" method="post"
                                        class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button onclick="return confirm('Hapus rak buku: {{ $rack->code }} ?')" type="submit"
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
