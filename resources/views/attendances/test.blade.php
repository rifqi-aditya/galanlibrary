@extends('layouts.main')

@section('main')
    @foreach ($users as $user)
        <div style="margin-bottom: 30px;">
            <p><strong>Nama:</strong> {{ $user->name }}</p>
            <p><strong>Barcode:</strong></p>
            {!! DNS2D::getBarcodeHTML($user->barcode, 'QRCODE') !!}
        </div>
        <hr>
    @endforeach
@endsection



@section('script')
@endsection
