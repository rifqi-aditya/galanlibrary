@extends('layouts.main')

@section('main')
    @can('read.statistics')
        <h4>Statistik Perpustakaan</h4>
        <hr>
        <div class="row mb-5">
            <div class="col-lg-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5>Jumlah Buku Berdasarkan Kategori</h5>
                        <div class="google-chart-wrap">
                            <div id="categoryChart" class="google-chart-content"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5>Peminjaman Buku Berdasarkan Kategori</h5>
                        <div class="google-chart-wrap">
                            <div id="borrowingCountChart" class="google-chart-content"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5>Status Pengembalian Buku</h5>
                        <div class="google-chart-wrap">
                            <div id="borrowingStatusChart" class="google-chart-content"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5>Pengunjung Perpustakaan Bulan Ini</h5>
                        <div class="google-chart-wrap">
                            <div id="attendanceChart" class="google-chart-content"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
    @endcan
    <div class="row">
        @can('read.books')
            <div class="col-lg-4 mb-3">
                <a href="{{ route('book.index') }}" class="text-decoration-none">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex h-100 justify-content-between align-items-center">
                                <div>
                                    <span class="material-icons card-icon text-primary">
                                        library_books
                                    </span>
                                </div>
                                <div class="text-end">
                                    <h5 class="mb-0 text-primary">Buku</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endcan
        @can('read.categories')
            <div class="col-lg-4 mb-3">
                <a href="{{ route('category.index') }}" class="text-decoration-none">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex h-100 justify-content-between align-items-center">
                                <div>
                                    <span class="material-icons card-icon text-success">
                                        category
                                    </span>
                                </div>
                                <div class="text-end">
                                    <h5 class="mb-0 text-success">Kategori</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endcan
        @can('read.racks')
            <div class="col-lg-4 mb-3">
                <a href="{{ route('rack.index') }}" class="text-decoration-none">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex h-100 justify-content-between align-items-center">
                                <div>
                                    <span class="material-icons card-icon text-danger">
                                        table_rows
                                    </span>
                                </div>
                                <div class="text-end">
                                    <h5 class="mb-0 text-danger">Rak</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endcan
        @can('read.publishers')
            <div class="col-lg-4 mb-3">
                <a href="{{ route('publisher.index') }}" class="text-decoration-none">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex h-100 justify-content-between align-items-center">
                                <div>
                                    <span class="material-icons card-icon text-warning">
                                        present_to_all
                                    </span>
                                </div>
                                <div class="text-end">
                                    <h5 class="mb-0 text-warning">Penerbit</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endcan
        @can('read.borrowings')
            <div class="col-lg-4 mb-3">
                <a href="{{ route('borrowing.index') }}" class="text-decoration-none">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex h-100 justify-content-between align-items-center">
                                <div>
                                    <span class="material-icons card-icon text-info">
                                        backpack
                                    </span>
                                </div>
                                <div class="text-end">
                                    <h5 class="mb-0 text-info">Peminjaman</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endcan
        @can('read.attendances')
            <div class="col-lg-4 mb-3">
                <a href="{{ route('attendance.index') }}" class="text-decoration-none">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex h-100 justify-content-between align-items-center">
                                <div>
                                    <span class="material-icons card-icon text-primary">
                                        receipt_long
                                    </span>
                                </div>
                                <div class="text-end">
                                    <h5 class="mb-0 text-primary">Daftar Hadir</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endcan
        @can('read.users')
            <div class="col-lg-4 mb-3">
                <a href="{{ route('user.index') }}" class="text-decoration-none">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex h-100 justify-content-between align-items-center">
                                <div>
                                    <span class="material-icons card-icon text-success">
                                        people
                                    </span>
                                </div>
                                <div class="text-end">
                                    <h5 class="mb-0 text-success">Akun Pengguna</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endcan
        @can('read.roles')
            <div class="col-lg-4 mb-3">
                <a href="{{ route('role.index') }}" class="text-decoration-none">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex h-100 justify-content-between align-items-center">
                                <div>
                                    <span class="material-icons card-icon text-danger">
                                        admin_panel_settings
                                    </span>
                                </div>
                                <div class="text-end">
                                    <h5 class="mb-0 text-danger">Role Pengguna</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endcan
        @can('create.reports')
            <div class="col-lg-4 mb-3">
                <a href="{{ route('report.index') }}" class="text-decoration-none">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex h-100 justify-content-between align-items-center">
                                <div>
                                    <span class="material-icons card-icon text-warning">
                                        print
                                    </span>
                                </div>
                                <div class="text-end">
                                    <h5 class="mb-0 text-warning">Laporan</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endcan
    </div>
@endsection

@section('script')
    @can('read.statistics')
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script>
            let categoryChartData = JSON.parse('{!! $categoryChartData !!}')
            let bookBorrowingChartData = JSON.parse('{!! $bookBorrowingChartData !!}')
            let borrowingStatusChartData = JSON.parse('{!! $borrowingCountChartData !!}')
            let thisMonthAttendancesChartData = JSON.parse('{!! $thisMonthAttendancesChartData !!}')

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

                new google.visualization.LineChart(document.getElementById('attendanceChart')).draw(
                    google.visualization.arrayToDataTable(thisMonthAttendancesChartData), {
                        legend: {
                            position: 'bottom'
                        }
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
