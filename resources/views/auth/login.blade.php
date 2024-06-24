@extends('layouts.main')

@section('main')
    <div class="row">
        <div class="col-lg-6 mx-auto">
            <h4 class="text-center mb-3">
                Login Ke Aplikasi
            </h4>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </form>
                    <div class="mt-3 text-center">
                        <a href="{{ route('password.request') }}" class="link-primary">Lupa password?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
