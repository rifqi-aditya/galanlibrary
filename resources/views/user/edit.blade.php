@extends('layouts.main')

@section('main')
    <h3 class="mb-4">Edit Akun Pengguna</h3>
    <form action="{{ route('user.update', $user) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="row">
            <div class="col-lg-8 mb-3">
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $user->name) }}">
                </div>
                <div class="mb-3">
                    <label for="date_of_birth" class="form-label">Tanggal Lahir</label>
                    <input type="date" name="date_of_birth" id="date_of_birth" class="form-control"
                        value="{{ old('date_of_birth', $user->date_of_birth ? $user->date_of_birth->format('Y-m-d') : '') }}">
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Alamat</label>
                    <textarea name="address" id="address" rows="3"
                        class="form-control">{{ old('address', $user->address) }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="picture" class="form-label">Foto</label>
                    <input type="file" name="picture" id="picture" class="form-control">
                    <small>*Kosongkan jika tidak ingin mengganti foto.</small>
                </div>
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="use_gravatar" name="use_gravatar"
                            id="use_gravatar">
                        <label class="form-check-label" for="use_gravatar">
                            Gunakan Gravatar (foto sebelumnya akan dihapus)
                        </label>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="email"
                        value="{{ old('email', $user->email) }}">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password">
                    <small>Kosongkan jika tidak ingin mengubah password</small>
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
                    <small>Kosongkan jika tidak ingin mengubah password</small>
                </div>
            </div>
            <div class="col-lg-4 mb-3">
                <div class="mb-3">
                    @php
                        $userRoles = $user->getRoleNames()->toArray();
                    @endphp

                    <label for="roles">Role</label>
                    @foreach ($roles as $role)
                        <div class="form-check">
                            <input name="roles[]" class="form-check-input"
                                {{ in_array($role->name, old('roles', $userRoles)) ? 'checked' : '' }} type="checkbox"
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
            <button type="submit" class="btn btn-dark btn-sm">Update</button>
        </div>
    </form>
@endsection
