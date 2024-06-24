@extends('layouts.main')

@section('main')
    <h3 class="mb-4">Buat Akun Pengguna</h3>
    <form action="{{ route('user.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-8 mb-3">
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                </div>
                <div class="mb-3">
                    <label for="date_of_bird" class="form-label">Tanggal Lahir</label>
                    <input type="date" name="date_of_bird" id="date_of_bird" class="form-control"
                        value="{{ old('date_of_bird') }}">
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Alamat</label>
                    <textarea name="address" id="address" rows="3" class="form-control">{{ old('address') }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="picture" class="form-label">Foto</label>
                    <input type="file" name="picture" id="picture" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
                </div>
            </div>
            <div class="col-lg-4 mb-3">
                <div class="mb-3">
                    <label for="roles">Role</label>
                    @foreach ($roles as $role)
                        <div class="form-check">
                            <input name="roles[]" class="form-check-input"
                                {{ in_array($role->name, old('roles') ?: []) ? 'checked' : '' }} type="checkbox"
                                value="{{ $role->name }}">
                            <label class="form-check-label">
                                {{ $role->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div>
            <button type="button" class="btn btn-outline-dark btn-sm" onclick="window.history.back()">Batal</button>
            <button type="submit" class="btn btn-dark btn-sm">Simpan</button>
        </div>
    </form>
@endsection
