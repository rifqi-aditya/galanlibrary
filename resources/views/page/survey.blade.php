@extends('layouts.main')

@section('main')
    <div class="row">
        <div class="col-lg-7 mx-auto" id="qr">
        <div class="text-center">
        <h2 style="font-weight: bold; font-size: 24px;">SURVEI KEPUASAN MEMBER</h2>
        </div>
        <br>
        </br>
            <div class="text-center">
                <p>Terima kasih telah menjadi member kami!</p>
                    <p>Kami sangat menghargai waktu Anda untuk mengisi survei ini. Jawaban Anda akan membantu kami meningkatkan layanan kami </p>
                <p> Klik tombol <strong>Konfirmasi</strong> untuk menampilkan QR Code dan memulai survei kepuasan member</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 mx-auto">
            <div class="text-center">
                <div class="text-center" id="confirm-attendance-wrapper">
                    <button id="confirm-attendance" class="btn btn-sm btn-dark">Konfirmasi</button>
                </div>
                <div id='progressbar' style="display: none"></div>
                <div style="display: none" class="text-center" id="qr-wrapper"></div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        let confirmButton = document.getElementById('confirm-attendance');
        let confirmButtonWrapper = document.getElementById('confirm-attendance-wrapper');
        let qrWrapper = document.getElementById('qr-wrapper');

        confirmButton.addEventListener('click', () => {
        qrWrapper.style.display = 'block';
        $.ajax({
            type: "get",
            url: "{{ route('attendance.qr') }}",
            data: [],
            dataType: "json",
            success: function(response) {
            qrWrapper.innerHTML = response.qr;
            document.querySelector('#qr-wrapper svg').setAttribute('width', '100%');
            document.querySelector('#qr-wrapper svg').setAttribute('height', '100%');
            }
        });
        confirmButtonWrapper.style.display = 'none'; // Hide confirm button wrapper after click
});

    </script>
@endsection
