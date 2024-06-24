@extends('layouts.main')

@section('main')
    <div class="row">
        <div class="col-lg-6 mx-auto">
            <h4 class="text-center mb-3">
                Ubah Password
            </h4>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('profile.updatePassword') }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Password Saat Ini</label>
                            <input type="password" class="form-control" id="current_password" name="current_password">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                            <input type="password" class="form-control" id="password_confirmation"
                                name="password_confirmation">
                        </div>
                        <div class="text-end">
                            <a href="{{ route('profile.index') }}" class="btn btn-sm btn-outline-dark">Batal</a>
                            <button type="submit" class="btn btn-dark btn-sm">Update Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
