@extends('layouts.main')

@section('main')
    <h3 class="mb-4">Edit Profil</h3>
    <div class="row">
        <div class="col-lg-2 mb-3">
            <img src="{{ $user->pictureURL() }}" class="user-picture shadow img-fluid w-100 rounded-circle mb-3">
        </div>
        <div class="col-lg-10 mb-3">
            <form action="{{ route('profile.update') }}" method="post">
                @csrf
                @method('put')
                <table class="table table-borderless">
                    <tr>
                        <td>Nomor Induk Siswa</td>
                        <td>
                            <input type="text" class="form-control" disabled value="{{ $user->username }}">
                        </td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>
                            <input name="name" type="text" class="form-control" value="{{ old('name', $user->name) }}">
                        </td>
                    </tr>
                    <tr>
                        <td>Tanggal Lahir</td>
                        <td>
                            <input name="date_of_bird" type="date" class="form-control"
                                value="{{ old('date_of_bird', $user->date_of_bird) }}">
                                {{-- value="{{ old('date_of_bird', '' ?? $user->date_of_bird->format('Y-m-d')) }}"> --}}
                        </td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>
                            <textarea name="address" class="form-control"
                                rows="3">{{ old('address', $user->address) }}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>
                            <input name="email" type="email" class="form-control"
                                value="{{ old('email', $user->email) }}">
                        </td>
                    </tr>
                    <tr>
                        <td>Nomor Handphone</td>
                        <td>
                            <input name="noHandphone" type="text" class="form-control"
                                value="{{ old('NoHandphone', $user->NoHandphone) }}">
                        </td>
                    </tr>
                </table>
                <div class="text-end">
                    <a href="{{ route('profile.index') }}" class="btn btn-sm btn-outline-dark">Batal</a>
                    <button type="submit" class="btn btn-dark btn-sm">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
