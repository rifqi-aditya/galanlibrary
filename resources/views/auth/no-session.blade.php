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
    <div class="pt-5 pb-5" style="background-color: #F6F5F2" id="Profile-Sekolah">
        <div style="display: flex; justify-content: center; align-content: center;">
            <h1 class="text-center fs-2" style="font-weight: bold;  width: fit-content;">Mengenal Perpustakaan Kami</h1>
        </div>
        <div style="margin-top: 30px;">
          <div style="display: flex; justify-content:center; align-items:center;padding-left: 50px; padding-right: 50px">
            <div style="width:40%; display: flex; justify-content: end; align-items: center ;padding-right: 30px">
                <img src="https://sman39jkt.sch.id/wp-content/uploads/2012/06/IMG_2064.jpg" alt="image" style="width: 65%;border-radius: 10px; box-shadow: #000 0px 0px 10px"></div>
            <div style="width: 60%;">
                <p class="text-center" style="padding-left: 20px;"> <span style="font-size: 25px;font-weight: bold;">Perpustakaan SMA Negeri 39 Jakarta </span>  menyediakan berbagai koleksi buku, jurnal, dan sumber daya digital yang dapat diakses oleh seluruh siswa dan staf pengajar. Kami berkomitmen untuk mendukung kegiatan belajar mengajar dengan menyediakan fasilitas yang lengkap dan nyaman. Selain itu, kami juga menawarkan layanan peminjaman buku, ruang baca yang kondusif, serta akses ke berbagai platform digital untuk memperkaya pengalaman belajar dan penelitian. Dengan demikian, kami berusaha menciptakan lingkungan</p>
            </div>

          </div>
        </div>
    </div>
</section>

@endsection
