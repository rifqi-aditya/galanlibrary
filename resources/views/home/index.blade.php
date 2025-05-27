@extends('layouts.main')

@section('main')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-lg">
                    <div class="card-header bg-gradient-primary text-white py-3">
                        <div class="d-flex align-items-center">
                            <div class="bg-white rounded-circle p-2 me-3">
                                <i class="fas fa-qrcode text-primary fa-lg"></i>
                            </div>
                            <div>
                                <h4 class="mb-0">Scan Pengembalian Buku</h4>
                                <p class="mb-0 opacity-75 small">Gunakan scanner untuk mengembalikan buku dengan mudah</p>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <!-- Alert Notifications -->
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show d-flex align-items-center">
                                <i class="fas fa-check-circle me-2"></i>
                                <div>{{ session('success') }}</div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <div>{{ session('error') }}</div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <!-- Scanner Section -->
                        <div class="text-center mb-4">
                            <div class="scanner-container mb-3 mx-auto">
                                <video id="scanner" class="rounded-3" style="background: #f8f9fa;"></video>
                                <div class="scanner-overlay" id="scanner-overlay"></div>
                            </div>
                            <p class="text-muted mb-4">
                                <i class="fas fa-lightbulb me-2"></i>Arahkan kamera ke barcode buku yang akan dikembalikan
                            </p>
                        </div>

                        <!-- Hidden Form -->
                        <form id="return-form" method="POST" action="{{ route('process.return') }}">
                            @csrf
                            <input type="hidden" name="barcode" id="barcode-input">
                        </form>

                        <!-- Scanner Controls -->
                        <div class="d-flex justify-content-center mb-4">
                            <button id="start-scanner" class="btn btn-primary btn-lg rounded-pill me-3 px-4">
                                <i class="fas fa-play me-2"></i> Mulai Scan
                            </button>
                            <button id="stop-scanner" class="btn btn-outline-secondary btn-lg rounded-pill px-4" disabled>
                                <i class="fas fa-stop me-2"></i> Stop
                            </button>
                        </div>

                        <!-- Divider -->
                        <div class="position-relative my-4">
                            <hr>
                            <div class="position-absolute top-50 start-50 translate-middle bg-white px-3 text-muted small">
                                ATAU
                            </div>
                        </div>

                        <!-- Manual Input -->
                        <div class="text-center">
                            <h5 class="mb-3 text-muted">
                                <i class="fas fa-keyboard me-2"></i>Input Manual
                            </h5>
                            <div class="input-group input-group-lg mx-auto" style="max-width: 400px;">
                                <input type="text" class="form-control rounded-start-pill"
                                    placeholder="Masukkan kode barcode">
                                <button class="btn btn-primary rounded-end-pill" type="button" id="manual-submit">
                                    <i class="fas fa-paper-plane me-1"></i> Kirim
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer bg-light py-3 text-center">
                        <small class="text-muted">
                            <i class="fas fa-info-circle me-1"></i> Pastikan barcode terlihat jelas dan dalam pencahayaan
                            yang cukup
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @can('read.statistics')
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script>
            let categoryChartData = JSON.parse('{!! $categoryChartData !!}')
            let bookBorrowingChartData = JSON.parse('{!! $bookBorrowingChartData !!}')
            let borrowingStatusChartData = JSON.parse('{!! $borrowingCountChartData !!}')

            function drawVisualization() {
                new google.visualization.PieChart(document.getElementById('categoryChart')).draw(
                    google.visualization.arrayToDataTable(categoryChartData), {
                        width: '100%',
                        height: '80%',
                        chartArea: {
                            left: "20%",
                            top: "1%",
                            height: "100%",
                            width: "100%"
                        },
                        is3D: true,
                    })

                new google.visualization.ColumnChart(document.getElementById('borrowingCountChart')).draw(
                    google.visualization.arrayToDataTable(bookBorrowingChartData), {
                        legend: {
                            position: 'bottom'
                        }
                    })

                new google.visualization.PieChart(document.getElementById('borrowingStatusChart')).draw(
                    google.visualization.arrayToDataTable(borrowingStatusChartData), {
                        width: '100%',
                        height: '80%',
                        chartArea: {
                            left: "20%",
                            top: "1%",
                            height: "100%",
                            width: "100%"
                        },
                        is3D: true,
                    })
            }

            google.charts.load('current', {
                'packages': ['corechart']
            })

            google.charts.setOnLoadCallback(drawVisualization);
            window.addEventListener('resize', function(event) {
                drawVisualization()
            })
        </script>
    @endcan
@endsection
