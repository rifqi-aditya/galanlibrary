@extends('layouts.main')

@section('main')
    <div class="row">
        <div class="col-lg-6 mx-auto">
            <h4 class="text-center mb-0">
                Lupa Password
                <br>
            </h4>
            <p class="text-center mb-3">
                <small>Kami akan mengirimkan link reset password ke email anda.</small>
            </p>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('password.request') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Kirim Link</button>
                        </div>
                    </form>
                    <div class="mt-3 text-center">
                        <a href="{{ route('login') }}" class="link-primary">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
