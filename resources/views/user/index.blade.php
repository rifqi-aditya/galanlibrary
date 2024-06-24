@extends('layouts.main')

@section('main')
    <h3 class="mb-4">Akun Pengguna</h3>
    <div class="mb-3">
        <a href="{{ route('home.index') }}" class="btn btn-sm btn-dark">Home</a>
        @can('create.users')
            <a href="{{ route('user.create') }}" class="btn btn-sm btn-dark">Buat Akun</a>
        @endcan
    </div>
    <div class="table-responsive">
        <table class="table table-bordered" id="user-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Dibuat pada</th>
                    @canany(['update.users', 'delete.users'])
                        <th class="text-center">Actions</th>
                    @endcanany
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $index => $user)
                    <tr>
                        <td>{{ ++$index }}</td>
                        <td class="text-center">
                            <img src="{{ $user->pictureURL() }}" width="35" height="35" class="rounded-circle">
                        </td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @forelse($user->roles as $role)
                                <span class="badge bg-success">{{ $role->name }}</span>
                            @empty
                                <span class="badge bg-danger">Tidak ada</span>
                            @endforelse
                        </td>
                        <td>{{ $user->created_at->format('d F Y') }}</td>
                        @canany(['update.users', 'delete.users'])
                            <td class="text-center">
                                <a href="{{ route('user.show', ['user' => $user]) }}"
                                    class="link-primary material-icons text-decoration-none">
                                    visibility
                                </a>
                                <a href="{{ route('user.edit', $user) }}"
                                    class="link-success material-icons text-decoration-none">
                                    edit
                                </a>
                                <a href="{{ route('user.delete', $user) }}"
                                    class="link-danger material-icons text-decoration-none">
                                    delete_forever
                                </a>
                            </td>
                        @endcanany
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
