@extends('layouts.main')

@section('main')
    <h2 class="text-center">Wishlist Book</h2>
    <div class="row mt-5 d-flex justify-content-center">
        @forelse($wishlists as $wishlist)
            <div class="col-lg-4 mb-3">
                <div class="card h-100 rounded-lg shadow-sm">
                    <div class="card-body">
                        <img src="{{ $wishlist->book->cover() }}" class="w-100 img-fluid rounded-lg mb-2">
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
