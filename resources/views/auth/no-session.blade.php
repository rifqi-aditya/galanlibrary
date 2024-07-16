@extends('layouts.main')

@section('main')
<section>
    <div class="position-relative py-lg-5 py-3" style="background-image: url('{{ asset('library.jpg') }}'); background-size: cover; background-position: center; height: 500px;">
        <!-- Overlay untuk membuat gambar lebih gelap -->
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background-color: rgba(0, 0, 0, 0.5);"></div>

    <div class="position-relative row h-100">
        <div class="col-lg-6 mb-3 d-lg-flex align-items-center order-lg-1 order-2">
            <div class="d-flex flex-column justify-content-center align-items-start p-10" style="height: 300px; padding-left: 10px;">
                <h4 class="bg-white text-black" style="padding: 15px 10px 15px 10px; font-weight: bold;">SELAMAT DATANG</h4>
                    <h1 class="text-white fs-4">Di Sistem Informasi Galan Library</h1>
                    <div class="mt-3">
                    <a href="{{ route('login') }}" style="padding: 10px 20px; background-color: #FFD966; color: black; border-radius: 10px;">Login</a>
                </div>
            </div>
            </div>
        </div>
    </div>

    <div style="margin-top: 100px;" id="Profile-Sekolah">
        <div style="display: flex; justify-content: center; align-content: center;">
            <h1 class="text-center fs-2" style="font-weight: bold; border-bottom: black 2px solid; width: fit-content;">Profile Sekolah</h1>
        </div>
        <div style="margin-top: 30px;">
            <p class="text-center">SMAN 39 Jakarta terletak di Jl. RA Fadhilah Cijantung, Pasar Rebo, Jakarta Timur, memiliki visi menjadi sekolah unggul dalam prestasi akademik dan non-akademik. Misinya mencakup menciptakan lingkungan belajar kondusif, mengembangkan potensi siswa, dan membangun karakter baik. Sekolah ini didirikan untuk menyediakan pendidikan berkualitas di Jakarta Timur. Fasilitasnya mencakup laboratorium, perpustakaan, dan fasilitas olahraga lengkap. SMAN 39 memiliki berbagai prestasi di tingkat nasional dan internasional, dengan tenaga pendidik yang berpengalaman dan berkualitas.</p>
        </div>
    </div>
</section>

@endsection
