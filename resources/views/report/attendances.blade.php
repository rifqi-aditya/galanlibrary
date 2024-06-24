@extends('layouts.report')

@section('main')
    <div class="content">
        <div class="header">
            <h5>Aksara Library System</h5>
            <h2>Laporan Absensi Kehadiran</h2>
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
                        <th>User</th>
                        <th>Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($attendances as $index => $attendance)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{ $attendance->user->name }}</td>
                            <td>{{ $attendance->created_at->format('d F Y h:i:s') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" style="text-align: center">Tidak Ada Data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
