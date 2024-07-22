@extends('layouts.main')

@section('main')
    <section class="vh-80">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100 pb-5">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="{{ asset('sign.png') }}" class="img-fluid w-100 " alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-8 col-xl-6 offset-xl-1">
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
                            <p class="lead fw-normal mb-10 me-3 fs-1">Sign up</p>
                        </div>

                        <!-- Name input -->
                        <div data-mdb-input-init class="form-outline mb-4">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control form-control-lg" id="name" name="name" value="{{ old('name') }}" placeholder="Enter your name">
                        </div>

                        <!-- NIS input -->
                        <div data-mdb-input-init class="form-outline mb-4">
                            <label for="nis" class="form-label">Nomor Induk Siswa</label>
                            <input type="text" class="form-control form-control-lg" id="nis" name="nis" value="{{ old('nis') }}" placeholder="Enter your NIS">
                        </div>

                        <!-- Email input -->
                        <div data-mdb-input-init class="form-outline mb-4">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control form-control-lg" id="email" name="email" value="{{ old('email') }}" placeholder="Enter a valid email address">
                        </div>

                        <!-- Password input -->
                        <div data-mdb-input-init class="form-outline mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Enter password">
                        </div>

                        <!-- Confirm Password input -->
                        <div data-mdb-input-init class="form-outline mb-3">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                            <input type="password" class="form-control form-control-lg" id="password_confirmation" name="password_confirmation" placeholder="Confirm your password">
                        </div>

                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" class="btn btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem; background-color: #FFD966;">Registrasi</button>
                            <p class="small fw-bold mt-2 pt-1 mb-0">Sudah punya akun? <a href="{{ route('login') }}" class="link-primary">Login</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
