@extends('layouts.main')

@section('main')
    <section class="position-relative py-lg-5 py-3"
        style="background-image: url('{{ asset('libraryy.jpg') }}'); background-size: cover; background-position: center; height: 250px;">
        <!-- Overlay untuk membuat gambar lebih gelap -->
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background-color: rgba(0, 0, 0, 0.5);"></div>

        <div class="position-relative row h-100">
            <div class="col-lg-6 mb-3 d-lg-flex align-items-center order-lg-1 order-2  w-100 justify-content-center">
                <div class="d-flex flex-column justify-content-center align-items-center p-10"
                    style="height: 150px; padding-left: 10px;">
                    <h2 class="text-white" style="padding: 15px 10px 15px 10px; font-weight:bold">Halo, {{ $user->name }}
                    </h2>
                    <h3 class="text-white fs-4">Mau baca buku apa hari ini?</h3>
                </div>
            </div>
        </div>
    </section>

    <form action="" method="get" style="margin-top: 20px;  padding-left: 20px;padding-right: 20px">
        <div class="row">
            <div class="col-lg-4 mb-3">
                <input placeholder="Cari berdasarkan judul atau penulis..." type="search" name="search"
                    class="form-control" value="{{ request()->query('search') }}">
            </div>
            <div class="col-lg-4 mb-3">
                <select name="category" class="form-control">
                    <option value="">Semua Kategori</option>
                    @foreach ($categories as $category)
                        <option {{ request('category') == $category->name ? 'selected' : '' }}
                            value="{{ $category->name }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-4 mb-3">
                <select name="publisher" class="form-control">
                    <option value="">Semua Penerbit</option>
                    @foreach ($publishers as $publisher)
                        <option {{ request('publisher') == $publisher->name ? 'selected' : '' }}
                            value="{{ $publisher->name }}">{{ $publisher->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-dark btn-sm">Cari Buku</button>
        </div>
    </form>
    @if (request('search') || request('category') || request('publisher'))
        <div class="text-center mb-4 mt-4">
            <h4 class="mb-0">{{ $books->total() }} Hasil Pencarian</h4>
            <a href="{{ route('home.index') }}">Bersihkan Pencarian</a>
        </div>
    @endif
    <div class="row mt-5 d-flex justify-content-center mb-5"
        style="margin-top: 20px;  padding-left: 20px;padding-right: 20px">
        @forelse($books as $book)
            <div class="col-lg-4 mb-3">
                <div class="card h-100 rounded-lg shadow-sm">
                    <div class="card-body">
                        <img src="{{ $book->cover() }}" class="w-100 img-fluid rounded-lg mb-2">
                        <div class="mb-2">
                            <span class="badge bg-primary">{{ $book->category->name }}</span>
                        </div>
                        <h6>{{ str()->limit($book->title, 50) }}</h6>
                        <div class="mb-2">
                            <small class="text-muted fst-italic">Oleh: {{ $book->author }}</small>
                            <br>
                            <small class="text-muted fst-italic">{{ $book->publisher->name }},
                                {{ $book->publication_year }}</small>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('home.bookDetail', ['book' => $book]) }}"
                            class="btn btn-sm btn-dark w-100 mb-2">Detail</a>
                        <button class="btn btn-sm w-100 btn-pinjam-buku" style="background-color: #F9B572; font-weight: 500"
                            data-book='@json($book)' data-bs-toggle="modal" data-bs-target="#modalPinjam">
                            Pinjam Buku
                        </button>

                    </div>
                </div>
            </div>
        @empty
            <div class="alert py-3 alert-warning text-center">
                <h6 class="mb-0">Tidak Ada Buku</h6>
            </div>
        @endforelse
    </div>
    <!-- Modal Pinjam -->
    <div class="modal fade" id="modalPinjam" tabindex="-1" aria-labelledby="modalPinjamLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="formPinjam" method="POST" action="{{ route('borrowings.store') }}">
                @csrf
                <input type="hidden" name="book_id" id="modalBookId">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalPinjamLabel">Konfirmasi Peminjaman Buku</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Judul:</strong> <span id="modalBookTitle"></span></p>
                        <p><strong>Penulis:</strong> <span id="modalBookAuthor"></span></p>
                        <p><strong>Penerbit:</strong> <span id="modalBookPublisher"></span></p>
                        <div class="mb-3">
                            <label for="number_of_books" class="form-label">Jumlah Buku</label>
                            <input type="number" class="form-control" name="number_of_books" min="1" value="1"
                                required disabled>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Ya, Setuju</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div>
        {{ $books->withQueryString()->links() }}
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const buttons = document.querySelectorAll(".btn-pinjam-buku");
            buttons.forEach(button => {
                button.addEventListener("click", function() {
                    const book = JSON.parse(this.getAttribute("data-book"));
                    document.getElementById("modalBookId").value = book.id;
                    document.getElementById("modalBookTitle").textContent = book.title;
                    document.getElementById("modalBookAuthor").textContent = book.author;
                    document.getElementById("modalBookPublisher").textContent = book.publisher.name;
                });
            });
        });
    </script>
@endsection
