@extends('layouts.homeLayout')

@section('main')
    <section style="width: 100%" class="">
        <div class="position-relative py-lg-5 py-3"
            style="background-image: url('{{ asset('images/library.jpg') }}'); background-size: cover; background-position: center; height: 500px; width: 100%">
            <!-- Overlay untuk membuat gambar lebih gelap -->
            <div class="position-absolute top-0 start-0 w-100 h-100" style="background-color: rgba(0, 0, 0, 0.8);"></div>

            <div class="position-relative row h-100">
                <div class="col-lg-6 mb-3 d-lg-flex align-items-center justify-content-center order-lg-1 order-2">
                    <div class="d-flex flex-column justify-content-center align-items-start p-10"
                        style="height: 300px; padding-left: 10px;">
                        <h4 class="fs-1 " style="font-weight: bold; width: 300px;width: 100%; color: #F9B572;">SELAMAT
                            DATANG</h4>
                        <h1 class="text-white fs-4">Di Sistem Informasi Galan Library</h1>
                        <div class="mt-3">
                            <a href="{{ route('login') }}"
                                style="padding: 10px 20px; background-color: #F9B572; color: black; border-radius: 10px; text-decoration: none; font-weight: bold;">Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </section>



    <section style="background-color: #F6F5F2; padding-top: 20px; padding-bottom: 20px">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <h1 class="display-4 fw-bold mb-4">Perpustakaan Digital untuk Generasi Muda</h1>
                    <p class="lead mb-4">Akses ribuan sumber belajar berkualitas kapan saja, di mana saja. Dukung proses
                        belajarmu dengan koleksi lengkap buku pelajaran, materi ujian, dan sumber ekstrakurikuler.</p>
                    <div class="d-flex gap-3">
                        <a href="/register" class="btn btn-light btn-lg px-4">Daftar Sekarang</a>
                        <a href="#features" style="background-color: #F9B572"
                            class="btn btn-outline-light btn-lg px-4">Pelajari Lebih Lanjut</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <img src="https://images.unsplash.com/photo-1589998059171-988d887df646?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80"
                        alt="Students reading" class="img-fluid rounded shadow">
                </div>
            </div>
        </div>
    </section>


    <!-- Features Section -->
    <section style="background-color: #F9B572" id="features" class="py-5 ">
        <div class="container py-5">
            <h2 style="color: #000" class="text-center section-title">Kenapa Perpustakaan Digital?</h2>
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div style="background-color: rgba(255, 255, 255, 0.9);" class="card p-4 text-center h-100">
                        <div class="feature-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h4>Akses 24/7 ke Sumber Belajar</h4>
                        <p>Dapatkan akses tak terbatas ke ribuan buku, artikel, jurnal, dan materi pelajaran lainnya kapan
                            saja dan di mana saja.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div style="background-color: rgba(255, 255, 255, 0.9);" class="card p-4 text-center h-100">
                        <div class="feature-icon">
                            <i class="fas fa-book"></i>
                        </div>
                        <h4>Koleksi Buku Lengkap</h4>
                        <p>Dari pelajaran sekolah hingga topik-topik yang sedang tren, kami memiliki koleksi lengkap untuk
                            mendukung proses belajarmu.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div style="background-color: rgba(255, 255, 255, 0.9);" class="card p-4 text-center h-100">
                        <div class="feature-icon">
                            <i class="fas fa-search"></i>
                        </div>
                        <h4>Fitur Pencarian Canggih</h4>
                        <p>Temukan informasi yang kamu butuhkan dengan cepat menggunakan sistem pencarian yang canggih dan
                            mudah digunakan.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div style="background-color: rgba(255, 255, 255, 0.9);" class="card p-4 text-center h-100">
                        <div class="feature-icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <h4>Panduan dan Tutorial</h4>
                        <p>Kami menyediakan tutorial dan panduan untuk membantu kamu memanfaatkan perpustakaan digital
                            secara maksimal.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Profile Sekolah --}}
    <div class="pt-5 pb-5" style="background-color: #F6F5F2" id="Profile-Sekolah">
        <div style="display: flex; justify-content: center; align-content: center;">
            <h1 class="text-center fs-2" style="font-weight: bold;  width: fit-content;">Mengenal Perpustakaan Kami</h1>
        </div>
        <div style="margin-top: 30px;">
            <div style="display: flex; justify-content:center; align-items:center;padding-left: 50px; padding-right: 50px">
                <div style="width:40%; display: flex; justify-content: end; align-items: center ;padding-right: 30px">
                    <img src="https://sman39jkt.sch.id/wp-content/uploads/2012/06/IMG_2064.jpg" alt="image"
                        style="width: 65%;border-radius: 10px; box-shadow: #000 0px 0px 10px">
                </div>
                <div style="width: 60%;">
                    <p class="text-center" style="padding-left: 20px;"> <span
                            style="font-size: 25px;font-weight: bold;">Perpustakaan SMA Negeri 39 Jakarta </span>
                        menyediakan berbagai koleksi buku, jurnal, dan sumber daya digital yang dapat diakses oleh
                        seluruh siswa dan staf pengajar. Kami berkomitmen untuk mendukung kegiatan belajar mengajar
                        dengan menyediakan fasilitas yang lengkap dan nyaman. Selain itu, kami juga menawarkan layanan
                        peminjaman buku, ruang baca yang kondusif, serta akses ke berbagai platform digital untuk
                        memperkaya pengalaman belajar dan penelitian. Dengan demikian, kami berusaha menciptakan
                        lingkungan</p>
                </div>

            </div>
        </div>
    </div>




    <!-- Collections Section -->
    <section style="background-color: #F9B572" id="collections" class="py-5">
        <div class="container py-5">
            <h2 style="color: #000" class="text-center section-title">Apa yang Bisa Kamu Temukan?</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div style="background-color: rgba(255, 255, 255, 0.9);" class="card p-4">
                        <img src="https://images.unsplash.com/photo-1434030216411-0b793f4b4173?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80"
                            class="card-img-top rounded mb-3" alt="Academic Education">
                        <h4>Edukasi Akademis</h4>
                        <p>Buku-buku pelajaran dari semua mata pelajaran SMA, mulai dari Matematika, Bahasa Indonesia,
                            hingga Sains dan Sejarah.</p>
                        <a href="#" class="btn btn-outline-primary mt-auto align-self-start">Jelajahi</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div style="background-color: rgba(255, 255, 255, 0.9);" class="card p-4">
                        <img src="https://images.unsplash.com/photo-1541178735493-479c1a27ed24?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80"
                            class="card-img-top rounded mb-3" alt="Extracurricular">
                        <h4>Sumber Daya untuk Kegiatan Ekstrakurikuler</h4>
                        <p>Perpustakaan ini juga memiliki sumber daya untuk mendukung kegiatan ekstrakurikuler seperti
                            jurnal seni, olahraga, dan pengembangan pribadi.</p>
                        <a href="#" class="btn btn-outline-primary mt-auto align-self-start">Jelajahi</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div style="background-color: rgba(255, 255, 255, 0.9);" class="card p-4">
                        <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80"
                            class="card-img-top rounded mb-3" alt="Exam Preparation">
                        <h4>Bahan untuk Persiapan Ujian</h4>
                        <p>Kami menyediakan materi yang dapat membantumu mempersiapkan ujian, baik itu ujian semester, ujian
                            nasional, maupun ujian masuk perguruan tinggi.</p>
                        <a href="#" class="btn btn-outline-primary mt-auto align-self-start">Jelajahi</a>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Testimonial Section -->
    <section class="py-5 bg-light">
        <div class="container py-5">
            <h2 class="text-center section-title">Apa Kata Pengguna Kami?</h2>
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="card border-0 bg-transparent text-center p-4">
                                    <img src="https://randomuser.me/api/portraits/women/32.jpg"
                                        class="rounded-circle mx-auto mb-3" width="100" alt="Testimonial 1">
                                    <p class="lead mb-3">"Perpustakaan digital ini sangat membantu saya dalam belajar.
                                        Koleksi bukunya lengkap dan mudah diakses kapan saja."</p>
                                    <h5 class="mb-1">Sarah Putri</h5>
                                    <p class="text-muted">Siswa SMA Negeri 5 Jakarta</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="card border-0 bg-transparent text-center p-4">
                                    <img src="https://randomuser.me/api/portraits/men/45.jpg"
                                        class="rounded-circle mx-auto mb-3" width="100" alt="Testimonial 2">
                                    <p class="lead mb-3">"Saya bisa menemukan referensi untuk persiapan UN dengan mudah.
                                        Fitur pencariannya sangat membantu!"</p>
                                    <h5 class="mb-1">Budi Santoso</h5>
                                    <p class="text-muted">Siswa SMA Negeri 8 Bandung</p>
                                </div>
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon bg-primary rounded-circle"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon bg-primary rounded-circle"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Premium Features Section -->
    {{-- <section id="premium-features" class="py-5" style="background-color: #F9B572;">
        <div class="container py-5">
            <h2 style="color: #fff" class="text-center section-title">Fasilitas Eksklusif</h2>
            <p class="text-center lead mb-5 text-dark">Nikmati fitur premium yang dirancang khusus untuk pengalaman belajar
                maksimal</p> --}}
{{--
            <div class="row g-4">
                {{-- {{-- <!-- Feature 1 --> --}}
                {{-- <div class="col-lg-6">
                    <div class="card p-4 h-100 border-0 shadow-sm" style="background-color: rgba(255, 255, 255, 0.9);">
                        <div class="d-flex align-items-start">
                            <div class="bg-white rounded-circle p-3 me-4 shadow-sm">
                                <i class="fas fa-headphones fa-2x" style="color: #2A4E6E;"></i>
                            </div>
                            <div>
                                <h4 style="color: #2A4E6E;">Buku Audio Interaktif</h4>
                                <p class="text-dark">Akses koleksi buku audio dengan fitur catatan digital dan kecepatan
                                    playback yang bisa disesuaikan.</p>
                                <span class="badge" style="background-color: #FFD966; color: #2C3E50;">Baru!</span>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <!-- Feature 2 -->
                {{-- <div class="col-lg-6">
                    <div class="card p-4 h-100 border-0 shadow-sm" style="background-color: rgba(255, 255, 255, 0.9);">
                        <div class="d-flex align-items-start">
                            <div class="bg-white rounded-circle p-3 me-4 shadow-sm">
                                <i class="fas fa-chalkboard-teacher fa-2x" style="color: #2A4E6E;"></i>
                            </div>
                            <div>
                                <h4 style="color: #2A4E6E;">Kelas Virtual</h4>
                                <p class="text-dark">Belajar langsung dengan tutor ahli melalui sesi kelas virtual
                                    interaktif setiap minggu.</p>
                                <span class="badge" style="background-color: #FFD966; color: #2C3E50;">Populer</span>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <!-- Feature 3 -->
                {{-- <div class="col-lg-6">
                    <div class="card p-4 h-100 border-0 shadow-sm" style="background-color: rgba(255, 255, 255, 0.9);">
                        <div class="d-flex align-items-start">
                            <div class="bg-white rounded-circle p-3 me-4 shadow-sm">
                                <i class="fas fa-bookmark fa-2x" style="color: #2A4E6E;"></i>
                            </div>
                            <div>
                                <h4 style="color: #2A4E6E;">Penyimpanan Premium</h4>
                                <p class="text-dark">Simpan hingga 500 buku favorit Anda dengan fitur organisasi koleksi
                                    pribadi.</p>
                                <span class="badge" style="background-color: #FFD966; color: #2C3E50;">10GB
                                    Storage</span>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <!-- Feature 4 -->
                {{-- <div class="col-lg-6">
                    <div class="card p-4 h-100 border-0 shadow-sm" style="background-color: rgba(255, 255, 255, 0.9);">
                        <div class="d-flex align-items-start">
                            <div class="bg-white rounded-circle p-3 me-4 shadow-sm">
                                <i class="fas fa-trophy fa-2x" style="color: #2A4E6E;"></i>
                            </div>
                            <div>
                                <h4 style="color: #2A4E6E;">Reward System</h4>
                                <p class="text-dark">Dapatkan poin dan badge eksklusif untuk setiap pencapaian belajar
                                    Anda.</p>
                                <a href="#" class="mt-2 d-inline-block"
                                    style="color: #2A4E6E; font-weight: 600;">Lihat Reward <i
                                        class="fas fa-arrow-right ms-2"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

            {{-- <div class="text-center mt-5">
                <a href="#" class="btn btn-lg px-5 py-3"
                    style="background-color: #2A4E6E; color: white; border-radius: 50px;">
                    <i class="fas fa-gem me-2"></i> Dapatkan Akses Premium
                </a>
                <p class="mt-3 text-dark">Garansi 30 hari uang kembali</p>
            </div> --}}
        {{-- </div>
    </section> --}}


    <!-- CTA Section -->
    <section style="background-color: #fff;" class="py-5  text-white">
        <div style="color: #000" class="container py-5 text-center">
            <h2 class="mb-4">Siap Memulai Perjalanan Belajarmu?</h2>
            <p class="lead mb-5">Bergabunglah dengan ribuan siswa lainnya yang telah merasakan manfaat perpustakaan digital
                kami.</p>
            <a href="/register" class="btn btn-light btn-lg px-5" style="background-color: #F9B572;">Daftar Gratis Sekarang</a>
        </div>
    </section>
@endsection
