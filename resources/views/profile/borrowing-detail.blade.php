@extends('layouts.main')

@section('main')
    <h3 class="mb-4">Detail Peminjaman Buku</h3>
    <div class="mb-3">
        <a href="{{ route('profile.borrowings') }}" class="btn btn-sm btn-dark">Kembali</a>
        @if ($borrowing->return_date == null)
            @can('update.borrowings')
                <a href="{{ route('borrowing.edit', ['borrowing' => $borrowing]) }}" class="btn btn-dark btn-sm">Edit</a>
            @endcan
            @can('delete.borrowings')
                <form class="d-inline" action="{{ route('borrowing.destroy', ['borrowing' => $borrowing]) }}"
                    method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger btn-sm"
                        onclick="return confirm('Hapus peminjaman buku? : {{ $borrowing->book->title }}')">Hapus</button>
                </form>
            @endcan
        @endif
    </div>
    <div class="row">
        <div class="col-lg-3 mb-3">
            <h5>Buku</h5>
            <img src="{{ $borrowing->book->cover() }}" class="img-fluid w-100">
        </div>
        <div class="col-lg-9 mb-3">
            <h5>Judul Buku</h5>
            <p>{{ $borrowing->book->title }}</p>
            <h5>Keterangan Buku</h5>
            <p>{{ $borrowing->book->description }}</p>
            <h5>Jumlah Dipinjam</h5>
            <p>{{ $borrowing->number_of_books }} buah</p>
            <h5>Kategori Buku</h5>
            <p>{{ $borrowing->book->category->name }}</p>
            <h5>Tanggal Pinjam</h5>
            <p>{{ $borrowing->created_at->format('d F Y') }}</p>
            <h5>Batas Waktu Pengembalian</h5>
            <p>{{ $borrowing->should_return_at->format('d F Y') }}</p>
        </div>
    </div>
    <div>
        <h5>Status Peminjaman Buku</h5>
        @if ($borrowing->return_date == null)
            <div class="alert alert-warning text-center">
                <p><strong>Buku masih dipinjam.</strong></p>
                <p>Sisa waktu peminjaman:
                    @if (now() > $borrowing->should_return_at)
                        <strong>0 Hari.</strong>
                    @else
                        <strong>{{ $borrowing->should_return_at->diffInDays(now()) }} Hari.</strong>
                    @endif
                </p>
            </div>
        @else
            <div class="alert alert-success text-center">
                <p><strong>Buku sudah dikembalikan.</strong></p>
                <p class="mb-0">
                    <strong>({{ $borrowing->book->category->name }}) -- {{ $borrowing->book->title }} --
                        {{ $borrowing->book->publisher->name }}</strong>
                    <br>
                    Tanggal Kembali: {{ $borrowing->return_date->format('d F Y') }}
                    <br>
                    Status pengembalian:
                    <strong>{{ $borrowing->return_status }}</strong>
                </p>
            </div>
        @endif
    </div>
@endsection
