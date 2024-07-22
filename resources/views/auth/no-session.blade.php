@extends('layouts.homeLayout')

@section('main')
<section style="width: 100%" class="">
    <div class="position-relative py-lg-5 py-3" style="background-image: url('{{ asset('library.jpg') }}'); background-size: cover; background-position: center; height: 500px; width: 100%">
        <!-- Overlay untuk membuat gambar lebih gelap -->
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background-color: rgba(0, 0, 0, 0.8);"></div>

    <div class="position-relative row h-100">
        <div class="col-lg-6 mb-3 d-lg-flex align-items-center justify-content-center order-lg-1 order-2">
            <div class="d-flex flex-column justify-content-center align-items-start p-10" style="height: 300px; padding-left: 10px;">
                <h4 class="fs-1 " style="font-weight: bold; width: 300px;width: 100%; color: #FFD966;">SELAMAT DATANG</h4>
                    <h1 class="text-white fs-4">Di Sistem Informasi Galan Library</h1>
                    <div class="mt-3">
                    <a href="{{ route('login') }}" style="padding: 10px 20px; background-color: #FFD966; color: black; border-radius: 10px; text-decoration: none; font-weight: bold;">Login</a>
                </div>
            </div>
            </div>
        </div>
    </div>
{{-- Profile Sekolah --}}
    <div style="margin-top: 100px;" id="Profile-Sekolah">
        <div style="display: flex; justify-content: center; align-content: center;">
            <h1 class="text-center fs-2" style="font-weight: bold;  width: fit-content;">Profile Sekolah</h1>
        </div>
        <div style="margin-top: 30px;">
          <div style="display: flex; justify-content:center; align-items:center;padding-left: 50px; padding-right: 50px">
            <div style="width: 50%">
                <img src="https://sman39jkt.sch.id/wp-content/uploads/2019/09/motto-sman39.jpg" alt="image" style="width: 100%;border-radius: 10px; box-shadow: #000 0px 0px 5px"></div>
            <div style="width: 50%">
                <p class="text-center" style="padding-left: 20px;"><span style="font-size: 30px;font-weight: bold">SMAN 39</span> Jakarta terletak di Jl. RA Fadhilah Cijantung, Pasar Rebo, Jakarta Timur, memiliki visi menjadi sekolah unggul dalam prestasi akademik dan non-akademik. Misinya mencakup menciptakan lingkungan belajar kondusif, mengembangkan potensi siswa, dan membangun karakter baik. Sekolah ini didirikan untuk menyediakan pendidikan berkualitas di Jakarta Timur. Fasilitasnya mencakup laboratorium, perpustakaan, dan fasilitas olahraga lengkap. SMAN 39 memiliki berbagai prestasi di tingkat nasional dan internasional, dengan tenaga pendidik yang berpengalaman dan berkualitas.</p>
            </div>

          </div>
        </div>
    </div>
</section>

@endsection
