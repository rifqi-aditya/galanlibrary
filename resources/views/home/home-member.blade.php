@extends('layouts.main')

@section('main')
<section class="position-relative py-lg-5 py-3" style="background-image: url('{{ asset('libraryy.jpg') }}'); background-size: cover; background-position: center; height: 250px;">
    <!-- Overlay untuk membuat gambar lebih gelap -->
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background-color: rgba(0, 0, 0, 0.5);"></div>

    <div class="position-relative row h-100">
        <div class="col-lg-6 mb-3 d-lg-flex align-items-center order-lg-1 order-2  w-100 justify-content-center">
            <div class="d-flex flex-column justify-content-center align-items-center p-10" style="height: 150px; padding-left: 10px;">
                <h2 class="text-white" style="padding: 15px 10px 15px 10px; font-weight:bold">Halo, {{ $user->name }}</h2>
                <h3 class="text-white fs-4">Mau baca buku apa hari ini?</h3>
              </div>
        </div>
    </div>
</section>

    <form action="" method="get" style="margin-top: 20px;  padding-left: 20px;padding-right: 20px">
        <div class="row">
            <div class="col-lg-4 mb-3">
                <input placeholder="Cari berdasarkan judul atau penulis..." type="search" name="search" class="form-control"
                    value="{{ request()->query('search') }}">
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
    <div class="row mt-5 d-flex justify-content-center mb-5" style="margin-top: 20px;  padding-left: 20px;padding-right: 20px">
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
                            class="btn btn-sm btn-dark w-100">Detail</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="alert py-3 alert-warning text-center">
                <h6 class="mb-0">Tidak Ada Buku</h6>
            </div>
        @endforelse
    </div>
    <div>
        {{ $books->withQueryString()->links() }}
    </div>
@endsection
