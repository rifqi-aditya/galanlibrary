@extends('layouts.main')

@section('main')
<section class="position-relative py-lg-5 py-3" style="background-image: url('{{ asset('library.jpg') }}'); background-size: cover; background-position: center; height: 500px;">
    <!-- Overlay untuk membuat gambar lebih gelap -->
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background-color: rgba(0, 0, 0, 0.5);"></div>

    <div class="position-relative row h-100">
        <div class="col-lg-6 mb-3 d-lg-flex align-items-center order-lg-1 order-2">
            <div class="d-flex flex-column justify-content-center align-items-start p-10" style="height: 300px; padding-left: 10px;">
                <h4 class="bg-white text-black" style="padding: 15px 10px 15px 10px;">SELAMAT DATANG</h4>
                <h1 class="text-white fs-4">Di Sistem Informasi Galan Library</h1>
                <div class="mt-3">
                    <a href="{{ route('login') }}" style="padding: 10px 20px; background-color: #FFD966; color: black; border-radius: 10px;">Login</a>
                </div>
            </div>
        </div>
        <!-- <div class="col-lg-6 order-lg-2 order-1 text-center mb-4 mb-lg-3">
            <img src="{{ asset('svg/book.svg') }}" alt="Book Illustration" class="img-fluid w-100">
        </div> -->
    </div>
</section>

@endsection
