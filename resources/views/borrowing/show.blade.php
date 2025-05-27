@extends('layouts.main')

@section('main')
    <h3 class="mb-4">Detail Peminjaman Buku</h3>
    <div class="mb-3">
        <a href="{{ route('borrowing.index') }}" class="btn btn-sm btn-dark">Kembali</a>
        @if ($borrowing->return_date == null)
            @can('update.borrowings')
                <a href="{{ route('borrowing.edit', ['borrowing' => $borrowing]) }}" class="btn btn-dark btn-sm">Edit</a>
            @endcan
            @can('delete.borrowings')
                <form class="d-inline" action="{{ route('borrowing.destroy', ['borrowing' => $borrowing]) }}" method="post">
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
            <h5>Nama Peminjam</h5>
            <p>
                {{ $borrowing->user->name }} -- {{ $borrowing->user->nis }}
                <br>
                <a href="{{ route('borrowing.showByUser', ['user' => $borrowing->user]) }}">Lihat semua semua peminjaman
                    oleh {{ $borrowing->user->name }}</a>
            </p>
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
        <div>
            <small class="text-muted d-block">{{ $borrowing->barcode }}</small>
            <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal"
                data-bs-target="#barcodeModal{{ $borrowing->id }}">
                <i class="fas fa-barcode"></i> Lihat Barcode
            </button>

            <!-- Tambahkan modal untuk menampilkan barcode -->
            <div class="modal fade" id="barcodeModal{{ $borrowing->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Barcode Peminjaman</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                            <div class="mb-3">
                                {!! DNS1D::getBarcodeHTML($borrowing->barcode, 'C128') !!}
                                <div class="mt-2">{{ $borrowing->barcode }}</div>
                            </div>
                            <p class="text-muted">Gunakan barcode ini untuk proses pengembalian</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
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
                @if ($borrowing->fine != null)
                    <p>Denda :
                        <strong>Rp. {{ sprintf('%s,00', number_format($borrowing->fine, 0, ',', '.')) }}</strong>
                    </p>
                @endif
                <div>
                    <form action="{{ route('borrowing.return', ['borrowing' => $borrowing]) }}" method="post">
                        @csrf
                        @method('put')
                        <input type="hidden" name="redirect-to" value="{{ url()->full() }}">
                        <button type="submit"
                            onclick="return confirm('Tandai sudah dikembalikan? : {{ $borrowing->book->title }}')"
                            class="btn btn-sm btn-warning mb-2">Tandai Sudah Dikembalikan</button>
                    </form>
                </div>
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
                    <br>
                    @if ($borrowing->fine != null)
                        Denda pengembalian :
                        <strong>Rp. {{ sprintf('%s,00', number_format($borrowing->fine, 0, ',', '.')) }}</strong>
                    @endif
                </p>
            </div>
        @endif
    </div>
@endsection
