@extends('layouts.main')

@section('main')
    <div class="container py-5">
        <div class="card border-0 shadow-lg overflow-hidden">
            <div class="card-header bg-gradient-primary text-white py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="mb-0"><i class="fas fa-book-reader me-2"></i>Pengembalian Buku</h3>
                    <div class="badge bg-white text-primary p-2">
                        <i class="fas fa-qrcode me-1"></i> Sistem Barcode
                    </div>
                </div>
            </div>

            <div class="card-body p-0">
                <div class="row g-0">
                    <!-- Scanner Section -->
                    <div class="col-lg-7 p-4">
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show mb-4">
                                <i class="fas fa-exclamation-triangle me-2"></i>{{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show mb-4">
                                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="scanner-container mb-4">
                            <div class="scanner-header d-flex justify-content-between align-items-center mb-3">
                                <h5 class="mb-0"><i class="fas fa-camera me-2"></i>Scanner Barcode</h5>
                                <button id="toggle-camera" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-sync-alt me-1"></i>Ganti Kamera
                                </button>
                            </div>

                            <div class="scanner-wrapper position-relative">
                                <div id="reader" class="rounded-3 overflow-hidden"></div>
                                <div class="scanline"></div>
                                <div class="corner top-left"></div>
                                <div class="corner top-right"></div>
                                <div class="corner bottom-left"></div>
                                <div class="corner bottom-right"></div>
                            </div>
                        </div>

                        <div class="guide-card bg-light-blue p-4 rounded-3">
                            <h5 class="d-flex align-items-center mb-3">
                                <i class="fas fa-info-circle me-2 text-primary"></i>Petunjuk Pengembalian
                            </h5>
                            <div class="guide-steps">
                                <div class="step d-flex mb-2">
                                    <div
                                        class="step-number bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3">
                                        1</div>
                                    <div class="step-text">Arahkan kamera ke barcode buku hingga terdeteksi otomatis</div>
                                </div>
                                <div class="step d-flex mb-2">
                                    <div
                                        class="step-number bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3">
                                        2</div>
                                    <div class="step-text">Atau masukkan kode barcode secara manual di kolom sebelah</div>
                                </div>
                                <div class="step d-flex">
                                    <div
                                        class="step-number bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3">
                                        3</div>
                                    <div class="step-text">Tunggu konfirmasi bahwa buku berhasil dikembalikan</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Manual Input Section -->
                    <div class="col-lg-5 bg-light-blue p-4">
                        <div class="manual-card bg-white p-4 rounded-3 h-100">
                            <h5 class="text-center mb-4"><i class="fas fa-keyboard me-2 text-primary"></i>Input Manual</h5>

                            <form id="return-form" method="POST" action="{{ route('process.return') }}">
                                @csrf
                                <div class="mb-4">
                                    <label for="manual-barcode" class="form-label fw-bold">Kode Barcode</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-primary text-white">
                                            <i class="fas fa-barcode"></i>
                                        </span>
                                        <input type="text" class="form-control form-control-lg border-primary"
                                            id="manual-barcode" name="barcode" placeholder="BRW-12345678"
                                            autocomplete="off">
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary btn-lg w-100 py-3 shadow-sm">
                                    <i class="fas fa-paper-plane me-2"></i>Proses Pengembalian
                                </button>
                            </form>

                            <div class="mt-4 pt-3 border-top">
                                <h6 class="d-flex align-items-center mb-3">
                                    <i class="fas fa-lightbulb me-2 text-warning"></i>Tips Cepat
                                </h6>
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Pastikan
                                        barcode terlihat jelas</li>
                                    <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Gunakan
                                        pencahayaan yang cukup</li>
                                    <li><i class="fas fa-check-circle text-success me-2"></i> Tahan buku tetap stabil saat
                                        scanning</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        let currentCameraId = null;
        let html5QrcodeScanner = null;
        let isProcessingScan = false;

        function initializeScanner(cameraId = null) {
            const config = {
                fps: 10,
                qrbox: {
                    width: 250,
                    height: 250
                },
                rememberLastUsedCamera: true
            };

            if (cameraId) {
                config.videoConstraints = {
                    deviceId: cameraId,
                    facingMode: "environment"
                };
            }

            if (html5QrcodeScanner) {
                html5QrcodeScanner.clear().then(() => {
                    html5QrcodeScanner = new Html5QrcodeScanner(
                        "reader", config, /* verbose= */ false);
                    html5QrcodeScanner.render(onScanSuccess);
                }).catch(err => {
                    console.error("Error clearing scanner: ", err);
                });
            } else {
                html5QrcodeScanner = new Html5QrcodeScanner(
                    "reader", config, /* verbose= */ false);
                html5QrcodeScanner.render(onScanSuccess);
            }
        }

        async function onScanSuccess(decodedText, decodedResult) {
            if (isProcessingScan) return;
            isProcessingScan = true;

            // Stop camera and remove scanner UI
            try {
                await html5QrcodeScanner.clear();
                document.getElementById('reader').innerHTML = '';
                document.querySelector('.scanline').style.display = 'none';
            } catch (err) {
                console.error("Error stopping scanner: ", err);
            }

            // Play sound
            const audio = new Audio('{{ asset('sound/beep.mp3') }}');
            audio.play().catch(e => console.log("Audio play failed:", e));

            // Show success animation
            const readerElement = document.getElementById('reader');
            readerElement.style.background = 'transparent';
            readerElement.innerHTML = `
            <div class="success-animation d-flex flex-column justify-content-center align-items-center h-100">
                <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                    <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/>
                    <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
                </svg>
                <div class="text-success mt-3 fw-bold">Barcode Terdeteksi!</div>
            </div>
        `;

            // Show alert
            await Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Memproses pengembalian buku...',
                showConfirmButton: false,
                timer: 2000,
                background: 'white',
                backdrop: `
                rgba(58,123,213,0.4)
                url("/images/loading.gif")
                center top
                no-repeat
            `
            });

            // Submit form
            document.getElementById("manual-barcode").value = decodedText;
            document.getElementById("return-form").submit();

            // Reset after delay
            setTimeout(() => {
                isProcessingScan = false;
                // initializeScanner(currentCameraId); // Uncomment to auto-restart
            }, 3000);
        }

        document.addEventListener('DOMContentLoaded', function() {
            initializeScanner();

            document.getElementById('toggle-camera').addEventListener('click', async function() {
                if (isProcessingScan) return;

                try {
                    const devices = await Html5Qrcode.getCameras();
                    if (devices && devices.length > 1) {
                        const currentIndex = currentCameraId ?
                            devices.findIndex(device => device.id === currentCameraId) : 0;
                        const nextIndex = (currentIndex + 1) % devices.length;
                        currentCameraId = devices[nextIndex].id;
                        initializeScanner(currentCameraId);

                        Swal.fire({
                            position: 'top-end',
                            icon: 'info',
                            title: `Kamera: ${devices[nextIndex].label || 'Kamera ' + (nextIndex + 1)}`,
                            showConfirmButton: false,
                            timer: 1500,
                            toast: true
                        });
                    } else {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'info',
                            title: 'Hanya 1 kamera tersedia',
                            showConfirmButton: false,
                            timer: 1500,
                            toast: true
                        });
                    }
                } catch (err) {
                    console.error("Error getting cameras: ", err);
                }
            });
        });
    </script>
@endsection
