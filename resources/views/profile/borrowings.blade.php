@extends('layouts.main')

@section('main')
    <h3 class="mb-4">Peminjaman Buku Saya</h3>
    <div class="mb-3">
        <a href="{{ route('profile.index') }}" class="btn btn-sm btn-dark">Kembali</a>
    </div>
    <div>
        @forelse ($borrowings as $borrowing)
            @if ($borrowing->return_date)
                <div class="alert alert-success">
                    <div class="row">
                        <div class="col-lg-9 mb-3 mb-lg-0">
                            <p class="mb-0">
                                <strong>({{ $borrowing->book->category->name }}) -- {{ $borrowing->book->title }} --
                                    {{ $borrowing->book->publisher->name }}</strong>
                                <br>
                                Tanggal Pinjam: {{ $borrowing->created_at->format('d F Y') }}
                                <br>
                                Batas Pengembalian: {{ $borrowing->should_return_at->format('d F Y') }}
                                <br>
                                Tanggal Kembali: {{ $borrowing->return_date->format('d F Y') }}
                                <br>
                                Status pengembalian:
                                <strong>{{ $borrowing->return_status }}</strong>
                            </p>
                        </div>
                        <div class="col-lg-3 mb-3 mb-lg-0 text-lg-end">
                            <button type="button" disabled class="btn btn-sm btn-success mb-2">Sudah Dikembalikan</button>
                            <a href="{{ route('profile.borrowingDetail', ['borrowing' => $borrowing]) }}"
                                class="btn btn-sm btn-success">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            @else
                <div class="alert alert-warning">
                    <div class="row">
                        <div class="col-lg-9 mb-3 mb-lg-0">
                            <p class="mb-0">
                                <strong>({{ $borrowing->book->category->name }}) -- {{ $borrowing->book->title }} --
                                    {{ $borrowing->book->publisher->name }}</strong>
                                <br>
                                Tanggal Pinjam: {{ $borrowing->created_at->format('d F Y') }}
                                <br>
                                Batas Pengembalian: {{ $borrowing->should_return_at->format('d F Y') }}
                                <br>
                                Sisa waktu peminjaman:
                                <strong>{{ $borrowing->should_return_at->diffInDays(now()) }} Hari.</strong>
                            </p>
                        </div>
                        <div class="col-lg-3 mb-3 mb-lg-0 text-lg-end">
                            <button type="button" disabled class="btn btn-sm btn-warning mb-2">Belum Dikembalikan</button>
                            <a href="{{ route('profile.borrowingDetail', ['borrowing' => $borrowing]) }}"
                                class="btn btn-sm btn-warning">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            @endif
        @empty
            <div class="alert alert-info text-center">
                <p><strong>Kamu belum meminjam buku apapun.</strong></p>
                <p class="mb-0">
                    Pergi ke perpustakaan dan pinjam buku sekarang! Membaca itu baik lho..
                </p>
            </div>
        @endforelse
    </div>
@endsection
