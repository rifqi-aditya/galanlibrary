@extends('layouts.main')

@section('main')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white py-3">
                        <div class="d-flex align-items-center">
                            <span class="material-icons md-36 me-3">qr_code_scanner</span>
                            <div>
                                <h4 class="mb-1">Scan Pengembalian Buku</h4>
                                <p class="mb-0 small opacity-75">Gunakan scanner untuk proses pengembalian yang lebih cepat
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <!-- Alert Notifications -->
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show d-flex align-items-center mb-4">
                                <span class="material-icons me-2">check_circle</span>
                                <div>{{ session('success') }}</div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center mb-4">
                                <span class="material-icons me-2">error</span>
                                <div>{{ session('error') }}</div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <!-- Scanner Section -->
                        <div class="text-center mb-4">
                            <div class="scanner-frame mb-3 mx-auto p-2 bg-dark rounded">
                                <video id="scanner" class="w-100" style="max-height: 300px;"></video>
                                <div class="scanner-guide"></div>
                            </div>
                            <p class="text-muted mb-4">
                                <span class="material-icons align-middle me-2">tips_and_updates</span>
                                Arahkan kamera ke barcode buku yang akan dikembalikan
                            </p>
                        </div>

                        <!-- Hidden Form -->
                        <form id="return-form" method="POST" action="{{ route('process.return') }}">
                            @csrf
                            <input type="hidden" name="barcode" id="barcode-input">
                        </form>

                        <!-- Scanner Controls -->
                        <div class="d-flex justify-content-center mb-4 gap-3">
                            <button id="start-scanner" class="btn btn-primary px-4">
                                <span class="material-icons align-middle me-2">play_arrow</span>
                                Mulai Scan
                            </button>
                            <button id="stop-scanner" class="btn btn-outline-secondary px-4" disabled>
                                <span class="material-icons align-middle me-2">stop</span>
                                Stop
                            </button>
                        </div>

                        <!-- Divider -->
                        <div class="position-relative my-4">
                            <hr class="my-4">
                            <div class="position-absolute top-50 start-50 translate-middle bg-white px-3 text-muted small">
                                ATAU
                            </div>
                        </div>

                        <!-- Manual Input -->
                        <div class="text-center">
                            <h5 class="mb-3 text-muted d-flex align-items-center justify-content-center">
                                <span class="material-icons me-2">keyboard</span>
                                Input Manual
                            </h5>
                            <div class="input-group mx-auto" style="max-width: 400px;">
                                <input type="text" class="form-control" placeholder="Masukkan kode barcode">
                                <button class="btn btn-primary" type="button" id="manual-submit">
                                    <span class="material-icons align-middle">send</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer bg-light py-3 text-center">
                        <small class="text-muted d-flex align-items-center justify-content-center">
                            <span class="material-icons md-18 me-2">info</span>
                            Pastikan barcode terlihat jelas dan dalam pencahayaan yang cukup
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- Include Instascan library untuk barcode scanning -->
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let scanner = null;
            const videoElem = document.getElementById('scanner');
            const startBtn = document.getElementById('start-scanner');
            const stopBtn = document.getElementById('stop-scanner');
            const barcodeInput = document.getElementById('barcode-input');
            const returnForm = document.getElementById('return-form');
            const manualInput = document.querySelector('.form-control');
            const manualSubmit = document.getElementById('manual-submit');

            startBtn.addEventListener('click', function() {
                Instascan.Camera.getCameras().then(function(cameras) {
                    if (cameras.length > 0) {
                        scanner = new Instascan.Scanner({
                            video: videoElem,
                            mirror: false
                        });

                        scanner.addListener('scan', function(content) {
                            barcodeInput.value = content;
                            returnForm.submit();
                        });

                        scanner.start(cameras[0]).then(function() {
                            startBtn.disabled = true;
                            stopBtn.disabled = false;
                        }).catch(function(e) {
                            console.error(e);
                            alert('Gagal memulai scanner: ' + e);
                        });
                    } else {
                        alert('Tidak ada kamera ditemukan!');
                    }
                }).catch(function(e) {
                    console.error(e);
                    alert('Error mengakses kamera: ' + e);
                });
            });

            stopBtn.addEventListener('click', function() {
                if (scanner) {
                    scanner.stop();
                    startBtn.disabled = false;
                    stopBtn.disabled = true;
                }
            });

            manualSubmit.addEventListener('click', function() {
                if (manualInput.value.trim() !== '') {
                    barcodeInput.value = manualInput.value.trim();
                    returnForm.submit();
                } else {
                    alert('Silakan masukkan kode barcode');
                }
            });

            // Submit juga ketika tekan enter di input manual
            manualInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    manualSubmit.click();
                }
            });
        });
    </script>
@endsection
