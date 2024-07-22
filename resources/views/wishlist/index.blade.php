@extends('layouts.main')

@section('main')
    <section class="position-relative py-lg-5 py-3" style="background-image: url('{{ asset('libraryy.jpg') }}'); background-size: cover; background-position: center; height: 250px;">
        <!-- Overlay untuk membuat gambar lebih gelap -->
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background-color: rgba(0, 0, 0, 0.5);"></div>

        <div class="position-relative row h-100">
            <div class="col-lg-6 mb-3 d-lg-flex align-items-center order-lg-1 order-2 w-100">
                <div class="d-flex flex-column justify-content-center align-items-center p-10 w-100" style="height: 150px; padding-left: 10px;">
                    <h2 class="text-center text-white " style="font-weight: bold">Wishlist Book</h2>
                </div>
            </div>
        </div>
    </section>
    {{-- <h2 class="text-center">Wishlist Book</h2> --}}
    <div class="row mt-5 d-flex justify-content-center">
        @forelse($wishlists as $wishlist)
            <div class="col-lg-4 mb-3">
                <div class="card h-100 rounded-lg shadow-sm">
                    <div class="card-body">
                        <img src="{{ $wishlist->book->cover}}" class="w-100 img-fluid rounded-lg mb-2">
                        <div class="mb-2">
                            <span class="badge bg-primary">{{ $wishlist->book->category->name }}</span>
                        </div>
                        <h6>{{ str()->limit($wishlist->book->title, 50) }}</h6>
                        <div class="mb-2">
                            <small class="text-muted fst-italic">Oleh: {{ $wishlist->book->author }}</small>
                            <br>
                            <small class="text-muted fst-italic">{{ $wishlist->book->publisher->name }},
                                {{ $wishlist->book->publication_year }}</small>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-center mb-3">
                            @if ($wishlist->book->stock > 0)
                                <div class="text-success d-flex align-items-center"><span
                                        class="material-symbols-outlined me-2">
                                        sentiment_satisfied
                                    </span> {{ $wishlist->book->stock }} in stock</div>
                            @else
                                <div class="text-danger d-flex align-items-center"><span
                                        class="material-symbols-outlined me-2">
                                        sentiment_dissatisfied
                                    </span> {{ $wishlist->book->stock }} in stock</div>
                            @endif
                        </div>
                        <a href="{{ route('home.bookDetail', ['book' => $wishlist->book]) }}"
                            class="btn btn-sm btn-dark w-100">Lihat Detail</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="alert py-3 alert-warning text-center">
                <h6 class="mb-0">Wishlish Masih Kosong</h6>
                <a class="btn btn-sm btn-warning mt-2" href="{{ route('home.index') }}">Cari Buku</a>
            </div>
        @endforelse
    </div>
    <div>
        {{ $wishlists->withQueryString()->links() }}
    </div>
@endsection
