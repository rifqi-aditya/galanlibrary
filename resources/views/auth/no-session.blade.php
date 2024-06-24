@extends('layouts.main')

@section('main')
    <section class="py-lg-5 py-3">
        <div class="row">
            <div class="col-lg-6 mb-3 d-lg-flex align-items-center order-lg-1 order-2">
                <div class="text-center text-lg-start">
                    <h4>Selamat datang di</h4>
                    <h1>Aksara Library</h1>
                    <div class="mt-3">
                        <a href="{{ route('login') }}" class="btn btn-dark btn-sm">Login</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 order-lg-2 order-1 text-center mb-4 mb-lg-3">
                <img src="{{ asset('svg/book.svg') }}" alt="Book Illustration" class="img-fluid w-100">
            </div>
        </div>
    </section>
@endsection
