@extends('layouts.main')

@php
    use Carbon\Carbon;
@endphp

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
                @if (Carbon::now()->diffInHours($borrowing->should_return_at, false) < 24 && Carbon::now()->diffInHours($borrowing->should_return_at, false) >= 0)
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Hai!</strong> 
                        <br>
                        <p>
                            Hanya ingin mengingatkan bahwa batas waktu pengembalian buku kamu sudah dekat. 
                            Pastikan untuk mengembalikan buku-buku yang kamu pinjam tepat waktu agar tidak dikenakan denda.
                        </p>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
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
                                Sisa waktu Peminjaman:
                                @if (now() > $borrowing->should_return_at)
                                    <strong>0 Hari.</strong>
                                @else
                                    <strong>{{ $borrowing->should_return_at->diffInDays(now()) }} Hari.</strong>
                                @endif
                                @if ($borrowing->fine != null) 
                                    <br>
                                    Denda Peminjaman :
                                    <strong>Rp. {{ sprintf('%s,00', number_format($borrowing->fine, 0, ',', '.')) }}</strong>
                                @endif
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
