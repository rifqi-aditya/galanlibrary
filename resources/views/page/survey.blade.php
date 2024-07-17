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
                <div class="text-center" id="confirm-survey-wrapper">
                    <button id="confirm-survey" class="btn btn-sm btn-dark">Konfirmasi</button>
                </div>
                <div id='progressbar' style="display: none"></div>
                <div style="display: none" class="text-center" id="qr-wrapper"></div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        let confirmButton = document.getElementById('confirm-survey');
        let confirmButtonWrapper = document.getElementById('confirm-survey-wrapper');
        let qrWrapper = document.getElementById('qr-wrapper');

        confirmButton.addEventListener('click', () => {
            qrWrapper.style.display = 'block';

            // Simpan URL gambar yang akan ditampilkan
            let imageUrl = "{{ asset('qrsurvey.png') }}";

            // Ganti innerHTML qrWrapper dengan tag img
            qrWrapper.innerHTML = `<img src="${imageUrl}" style="width: 100%; height: auto;">`;

            confirmButtonWrapper.style.display = 'none'; // Sembunyikan wrapper tombol konfirmasi setelah diklik
        });
    </script>
@endsection
