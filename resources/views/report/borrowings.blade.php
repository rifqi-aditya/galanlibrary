@extends('layouts.report')

@section('main')
    <div class="content">
        <div class="header">
            <h5>E-Library System</h5>
            <h2>Laporan Peminjaman Buku</h2>
            <h4>Tanggal Pelaporan: {{ now()->format('d/m/Y') }}</h4>
            @if ($filterInformation)
                <p>Periode Waktu: {{ $filterInformation }}</p>
            @endif
            <hr>
        </div>
        <div class="data">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Judul Buku</th>
                        <th>Kategori</th>
                        <th>User</th>
                        <th>Jumlah Pinjam</th>
                        <th>Tanggal Pinjam</th>
                        <th>Batas Pengembalian</th>
                        <th>Status Pengembalian</th>
                        <th>Tanggal Kembali</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($borrowings as $index => $borrowing)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{ $borrowing->book->title }}</td>
                            <td>{{ $borrowing->book->category->name }}</td>
                            <td>{{ $borrowing->user->name }}</td>
                            <td style="text-align: center">{{ $borrowing->number_of_books }}</td>
                            <td>{{ $borrowing->created_at->format('d F Y') }}</td>
                            <td>{{ $borrowing->should_return_at->format('d F Y') }}</td>
                            <td>
                                @if ($borrowing->return_date == null)
                                    Masih Dipinjam
                                @else
                                    {{ $borrowing->return_status }}
                                @endif
                            </td>
                            <td>
                                @if ($borrowing->return_date == null)
                                    NIHIL
                                @else
                                    {{ $borrowing->return_date->format('d/m/Y') }}
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" style="text-align: center">Tidak Ada Data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
