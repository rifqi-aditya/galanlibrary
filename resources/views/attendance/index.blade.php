@extends('layouts.main')

@section('main')
    <h3 class="mb-4">Daftar Hadir</h3>
    <div class="mb-3">
        <a href="{{ route('home.index') }}" class="btn btn-sm btn-dark">Home</a>
    </div>
    <div class="table-responsive">
        <table class="table" id="attendance-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Waktu</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($attendances as $index => $attendance)
                    <tr>
                        <td>{{ ++$index }}</td>
                        <td>{{ $attendance->user->name }}</td>
                        <td>{{ $attendance->created_at->format('d F Y h:i:s') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
