@extends('layouts.main')

@section('main')
    <h3 class="mb-4">Detail User</h3>
    <div class="mb-3">
        <a href="{{ route('user.index') }}" class="btn btn-sm btn-dark">Kembali</a>
        @can('update.users')
            <a href="{{ route('user.edit', ['user' => $user]) }}" class="btn btn-sm btn-dark">Edit User</a>
        @endcan
        @can('delete.users')
            <a href="{{ route('user.delete', $user) }}" class="btn btn-sm btn-danger">
                Hapus User
            </a>
        @endcan
    </div>
    <div class="row">
        <div class="col-lg-2 mb-3">
            <img src="{{ $user->pictureURL() }}" class="user-picture shadow img-fluid w-100 rounded-circle mb-3">
        </div>
        <div class="col-lg-10 mb-3">
            <table class="table table-borderless">
                <tr>
                    <td>Identifier</td>
                    <td>
                        <input type="text" class="form-control" disabled value="{{ $user->nis }}">
                    </td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td>
                        <input type="text" class="form-control" disabled value="{{ $user->name }}">
                    </td>
                </tr>
                <tr>
                    <td>Tanggal Lahir</td>
                    <td>
                        <input type="text" class="form-control" disabled
                            value="{{ '' ?? $user->date_of_birth->format('d F Y') }}">
                    </td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>
                        <textarea class="form-control" disabled rows="3">{{ $user->address }}</textarea>
                    </td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>
                        <input type="email" class="form-control" disabled value="{{ $user->email }}">
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <hr>
    <div class="row">
        @if ($user->hasRole('member'))
            @can('read.borrowings')
                <div class="col-lg-4 mb-3">
                    <a href="{{ route('borrowing.showByUser', ['user' => $user]) }}" class="text-decoration-none">
                        <div class="card shadow-sm h-100">
                            <div class="card-body">
                                <div class="d-flex h-100 justify-content-between align-items-center">
                                    <div>
                                        <span class="material-icons card-icon text-danger">
                                            backpack
                                        </span>
                                    </div>
                                    <div class="text-end">
                                        <h5 class="mb-0 text-danger">Buku Yang Dipinjam</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endcan
        @endif
    </div>
@endsection
