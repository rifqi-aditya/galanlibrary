@extends('layouts.main')

@section('main')
    <div class="row">
        <div class="col-lg-6 mx-auto">
            <h3 class="mb-4 text-center">Konfirmasi Hapus Akun Pengguna</h3>
            <form action="{{ route('user.destroy', $user) }}" method="post">
                @csrf
                @method('delete')
                <div class="mb-3">
                    <input autofocus type="password" class="form-control text-center" placeholder="Masukkan password anda"
                        name="password" id="password">
                </div>
                <div class="text-center">
                    <button type="button" class="btn btn-outline-dark btn-sm" onclick="window.history.back()">Batal</button>
                    <button type="submit" class="btn btn-dark btn-sm">Konfirmasi Hapus</button>
                </div>
            </form>
        </div>
    </div>
@endsection
