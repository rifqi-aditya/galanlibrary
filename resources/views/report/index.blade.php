@extends('layouts.main')

@section('main')
    <h3 class="mb-4">Laporan</h3>
    <div class="mb-3">
        <a href="{{ route('home.index') }}" class="btn btn-sm btn-dark">Home</a>
    </div>
    <div class="row">
        <div class="col-lg-6 mb-3">
            <div class="card shadow">
                <div class="card-header bg-primary">
                    <h6 class="mb-0 text-white">Laporan Peminjaman Buku</h6>
                </div>
                <div class="card-body">
                    <form target="blank" action="{{ route('report.borrowings') }}" method="get">
                        <div class="mb-3">
                            <label for="start_date" class="form-label">Tanggal Awal</label>
                            <input type="date" name="start_date" id="start_date" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="end_date" class="form-label">Tanggal Akhir</label>
                            <input type="date" name="end_date" id="end_date" class="form-control">
                        </div>
                        <div class="row g-1">
                            <div class="col-sm-6 mb-2">
                                <button type="submit" class="btn btn-primary btn-sm w-100">Cetak</button>
                            </div>
                            <div class="col-sm-6 mb-2">
                                <a target="blank" href="{{ route('report.borrowings') }}"
                                    class="btn btn-primary btn-sm w-100">Cetak
                                    Semua</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
