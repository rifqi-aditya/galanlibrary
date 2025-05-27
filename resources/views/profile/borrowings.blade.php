@extends('layouts.main')



@section('main')

    <div class="mb-3">
        <a href="{{ route('profile.index') }}" class="btn btn-sm btn-dark">Kembali</a>
    </div>
    <div class="container py-4">
        <h1 class="mb-4 text-primary">Riwayat Peminjaman Buku</h1>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Peminjaman Menunggu Konfirmasi -->
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-warning text-white">
                <h2 class="h5 mb-0">
                    <i class="fas fa-clock me-2"></i>Menunggu Konfirmasi
                </h2>
            </div>
            <div class="card-body">
                @if ($pendingBorrowings->isEmpty())
                    <div class="alert alert-info mb-0">
                        Tidak ada peminjaman yang menunggu konfirmasi.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Judul Buku</th>
                                    <th>Tanggal Pinjam</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pendingBorrowings as $borrowing)
                                    <tr>
                                        <td>{{ $borrowing->book->title }}</td>
                                        <td>{{ $borrowing->created_at->format('d M Y') }}</td>

                                        <td>
                                            <span class="badge bg-warning text-dark">
                                                <i class="fas fa-clock me-1"></i> {{ $borrowing->status }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

        <!-- Peminjaman Aktif -->
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-primary text-white">
                <h2 class="h5 mb-0">
                    <i class="fas fa-book-open me-2"></i>Sedang Dipinjam
                </h2>
            </div>
            <div class="card-body">
                @if ($approvedNotReturned->isEmpty())
                    <div class="alert alert-info mb-0">
                        Tidak ada buku yang sedang dipinjam.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Judul Buku</th>
                                    <th>Tanggal Pinjam</th>
                                    <th>Batas Pengembalian</th>
                                    <th>Status</th>
                                    <th>Denda</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($approvedNotReturned as $borrowing)
                                    <tr class="{{ $borrowing->fine > 0 ? 'table-danger' : '' }}">
                                        <td>{{ $borrowing->book->title }}</td>
                                        <td>{{ $borrowing->created_at->format('d M Y') }}</td>
                                        <td>{{ Carbon\Carbon::parse($borrowing->should_return_at)->format('d M Y') }}</td>
                                        <td>
                                            <span class="badge bg-success">
                                                <i class="fas fa-check-circle me-1"></i> {{ $borrowing->status }}
                                            </span>
                                        </td>
                                        <td>
                                            @if ($borrowing->fine >= 0)
                                                <span class="text-danger fw-bold">Rp
                                                    {{ number_format($borrowing->fine, 0, ',', '.') }}</span>
                                            @else
                                                <span class="text-success">Tidak ada dendasss</span>
                                            @endif
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

        <!-- Riwayat Peminjaman -->
        <div class="card shadow-sm">
            <div class="card-header bg-info text-white">
                <h2 class="h5 mb-0">
                    <i class="fas fa-history me-2"></i>Riwayat Peminjaman
                </h2>
            </div>
            <div class="card-body">
                @if ($approvedReturned->isEmpty())
                    <div class="alert alert-info mb-0">
                        Belum ada riwayat peminjaman.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Judul Buku</th>
                                    <th>Tanggal Pinjam</th>
                                    <th>Tanggal Kembali</th>
                                    <th>Status</th>
                                    <th>Denda</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($approvedReturned as $borrowing)
                                    <tr>
                                        <td>{{ $borrowing->book->title }}</td>
                                        <td>{{ $borrowing->created_at->format('d M Y') }}</td>
                                        <td>{{ Carbon\Carbon::parse($borrowing->return_date)->format('d M Y') }}</td>
                                        <td>
                                            <span class="badge bg-secondary">
                                                <i class="fas fa-archive me-1"></i> Sudah dikembalikan
                                            </span>
                                        </td>
                                        <td>
                                            @if ($borrowing->fine > 0)
                                                <span class="text-danger">Rp
                                                    {{ number_format($borrowing->fine, 0, ',', '.') }} (Lunas)</span>
                                            @else
                                                <span class="text-success">Tidak ada denda</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .card {
            border-radius: 10px;
            overflow: hidden;
        }

        .card-header {
            font-weight: 600;
        }

        .table th {
            font-weight: 600;
            color: #495057;
        }

        .badge {
            padding: 0.5em 0.75em;
            font-size: 0.85em;
            font-weight: 500;
        }

        .alert {
            border-radius: 8px;
        }

        .shadow-sm {
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
        }
    </style>
@endsection
