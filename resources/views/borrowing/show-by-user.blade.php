@extends('layouts.main')

@section('main')
    <h3 class="mb-4">Peminjaman Buku Oleh {{ $user->name }} -- {{ $user->nis }}</h3>
    <div class="mb-3">
        <a href="{{ route('borrowing.index') }}" class="btn btn-sm btn-dark">Kembali</a>
    </div>
    <div>
        @forelse ($user->borrowings as $borrowing)
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
                                Tanggal Pengembalian: {{ $borrowing->should_return_at->format('d F Y') }}
                                <br>
                                Tanggal Kembali: {{ $borrowing->return_date->format('d F Y') }}
                                <br>
                                Status pengembalian:
                                <strong>{{ $borrowing->return_status }}</strong>
                            </p>
                        </div>
                        <div class="col-lg-3 mb-3 mb-lg-0 text-lg-end">
                            <button type="button" disabled class="btn btn-sm btn-success mb-2">Sudah Dikembalikan</button>
                            <a href="{{ route('borrowing.show', ['borrowing' => $borrowing]) }}"
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
                                Tanggal Pengembalian: {{ $borrowing->should_return_at->format('d F Y') }}
                                <br>
                                Sisa waktu peminjaman:
                                <strong>{{ $borrowing->should_return_at->diffInDays(now()) }} Hari.</strong>
                            </p>
                        </div>
                        <div class="col-lg-3 mb-3 mb-lg-0 text-lg-end">
                            @can('update.borrowings')
                                <form action="{{ route('borrowing.return', ['borrowing' => $borrowing]) }}" method="post">
                                    @csrf
                                    @method('put')
                                    <input type="hidden" name="redirect-to" value="{{ url()->full() }}">
                                    <button type="submit"
                                        onclick="return confirm('Tandai sudah dikembalikan? : {{ $borrowing->book->title }}')"
                                        class="btn btn-sm btn-warning mb-2">Tandai Sudah Dikembalikan</button>
                                </form>
                            @endcan
                            <a href="{{ route('borrowing.show', ['borrowing' => $borrowing]) }}"
                                class="btn btn-sm btn-warning">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            @endif
        @empty
            <div class="alert alert-info text-center">
                <p class="mb-0"><strong>{{ $user->name }} belum meminjam buku apapun.</strong></p>
            </div>
        @endforelse
    </div>
@endsection
