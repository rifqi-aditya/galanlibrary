@extends('layouts.main')

@section('main')
    <h3 class="mb-4">Data Peminjaman Buku</h3>
    <div class="mb-3">
        <a href="{{ route('home.index') }}" class="btn btn-sm btn-dark">Home</a>
        @can('create.borrowings')
            <a href="{{ route('borrowing.create') }}" class="btn btn-sm btn-dark">Tambah Peminjaman</a>
        @endcan
    </div>
    <div class="table-responsive mb-4">
        <table class="table table-bordered" id="active-borrowing-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Judul Buku</th>
                    <th>User</th>
                    <th>Jumlah Pinjam</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Pengembalian</th>
                    <th>Denda</th>
                    @canany(['update.borrowings', 'delete.borrowings'])
                        <th class="text-center">Actions</th>
                    @endcanany
                </tr>
            </thead>
            <tbody>
                @foreach ($activeBorrowings as $index => $activeBorrowing)
                    <tr>
                        <td style="width: 30px;">{{ ++$index }}</td>
                        <td>{{ $activeBorrowing->book->title }}</td>
                        <td>{{ $activeBorrowing->user->name }}</td>

                        <td>
                            @if ($activeBorrowing->status === 'menunggu konfirmasi')
                                <span class="badge bg-warning text-dark">{{ $activeBorrowing->status }}</span>
                            @else
                                <span class="badge bg-success">{{ $activeBorrowing->status }}</span>
                            @endif
                        </td>

                        <td>{{ $activeBorrowing->created_at->format('d F Y') }}</td>

                        @if ($activeBorrowing->status === 'disetujui')
                            <td>{{ $activeBorrowing->should_return_at->format('d F Y') }}</td>
                        @else
                            <td class="text-center">-</td>
                        @endif
                        @if ($activeBorrowing->fine != null)
                            <td>Rp. {{ sprintf('%s,00', number_format($activeBorrowing->fine, 0, ',', '.')) }}</td>
                        @else
                            <td class="text-center">-</td>
                        @endif
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <!-- Icon Show -->

                                @if ($activeBorrowing->status === 'disetujui')
                                    <a href="{{ route('borrowing.show', ['borrowing' => $activeBorrowing]) }}"
                                        class="link-primary material-icons text-decoration-none" title="Lihat Detail">
                                        visibility
                                    </a>
                                @endif

                                <!-- Icon Checklist -->
                                @if ($activeBorrowing->status === 'menunggu konfirmasi')
                                    <form action="{{ route('borrowings.confirm', ['borrowing' => $activeBorrowing]) }}"
                                        method="POST" style="display: inline;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline text-success"
                                            title="Konfirmasi">
                                            <span class="material-icons">check_circle</span>
                                        </button>
                                    </form>
                                @endif


                            </div>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <h3 class="mb-4">Data Pengembalian Buku</h3>
    <div class="table-responsive">
        <table class="table table-bordered" id="returned-borrowing-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Judul Buku</th>
                    <th>User</th>
                    <th>Jumlah Pinjam</th>
                    <th>Tanggal Pinjam</th>
                    <th>Batas Pengembalian</th>
                    <th>Tanggal Kembali</th>
                    <th>Status Pengembalian</th>
                    @canany(['update.borrowings', 'delete.borrowings'])
                        <th class="text-center">Actions</th>
                    @endcanany
                </tr>
            </thead>
            <tbody>
                @foreach ($returnedBorrowings as $index => $returnedBorrowing)
                    <tr>
                        <td style="width: 30px;">{{ ++$index }}</td>
                        <td>{{ $returnedBorrowing->book->title }}</td>
                        <td>{{ $returnedBorrowing->user->name }}</td>
                        <td>{{ $returnedBorrowing->number_of_books }}</td>
                        <td>{{ $returnedBorrowing->created_at->format('d F Y') }}</td>
                        <td>{{ $returnedBorrowing->should_return_at->format('d F Y') }}</td>
                        <td>{{ $returnedBorrowing->return_date->format('d F Y') }}</td>
                        <td>{{ $returnedBorrowing->return_status }}</td>
                        <td class="text-center">
                            <a href="{{ route('borrowing.show', ['borrowing' => $returnedBorrowing]) }}"
                                class="link-primary material-icons text-decoration-none">
                                visibility
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
