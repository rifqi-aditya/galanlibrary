@extends('layouts.main')

@section('main')
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- Profile Card with Glass Morphism Effect -->
                <div class="card border-0 shadow-lg overflow-hidden mb-4" style="border-radius: 20px;">
                    <div class="card-header position-relative"
                        style="background: linear-gradient(135deg, #A86523 0%, #E9A319 100%); height: 120px;">
                        <div class="position-absolute top-0 end-0 p-3">
                            <span class="badge bg-white text-primary fs-6 shadow-sm">ID: {{ $user->id }}</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center text-white">
                            <h4 class="mb-0 fw-bold">Detail Absensi</h4>
                            <div class="blob"></div>
                        </div>
                    </div>

                    <div class="card-body position-relative" style="z-index: 1;">
                        <!-- Floating Profile Picture -->
                        <div class="position-absolute  start-50 translate-middle" style="margin-top: -75px; top: 70px;">
                            <div class="border-4 border-white rounded-circle shadow-lg"
                                style="width: 150px; height: 150px; border-style: solid; border-width: 5px;">
                                <img src="{{ $user->pictureURL() }}" alt="Profile Picture"
                                    class="img-fluid rounded-circle w-100 h-100" style="object-fit: cover;">
                            </div>
                        </div>

                        <!-- User Info Section -->
                        <div class="row mt-5 pt-4">
                            <div class="col-md-6">
                                <div class="info-card p-4 mb-4" style="background-color: #f8f9fa; border-radius: 15px;">
                                    <h3 class="fw-bold text-gradient mb-3"
                                        style="background: linear-gradient(135deg, #A86523 0%, #E9A319 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                                        {{ $user->name }}
                                    </h3>
                                    <p class="text-muted mb-4">
                                        <i class="fas fa-envelope me-2"></i>{{ $user->email }}
                                    </p>

                                    <div class="d-flex align-items-center mb-3">
                                        <div class="me-3">
                                            <div class="icon-circle bg-primary-light">
                                                <i class="fas fa-qrcode text-primary"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <h6 class="text-muted small mb-1">Barcode</h6>
                                            <p class="fw-bold">{{ $user->barcode }}</p>
                                            <div class="mt-2">
                                                {!! DNS2D::getBarcodeHTML($user->barcode, 'QRCODE', 4, 4) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-card p-4 h-100" style="background-color: #f8f9fa; border-radius: 15px;">
                                    <div class="row">
                                        <div class="col-6 mb-4">
                                            <div class="d-flex align-items-center">
                                                <div class="me-3">
                                                    <div class="icon-circle bg-success-light">
                                                        <i class="fas fa-calendar-check text-success"></i>
                                                    </div>
                                                </div>
                                                <div>
                                                    <h6 class="text-muted small mb-1">Registrasi</h6>
                                                    <p class="fw-bold mb-0">
                                                        {{ \Carbon\Carbon::parse($user->created_at)->format('d M Y') }}</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-6 mb-4">
                                            <div class="d-flex align-items-center">
                                                <div class="me-3">
                                                    <div class="icon-circle bg-info-light">
                                                        <i class="fas fa-sync-alt text-info"></i>
                                                    </div>
                                                </div>
                                                <div>
                                                    <h6 class="text-muted small mb-1">Terakhir Update</h6>
                                                    <p class="fw-bold mb-0">
                                                        {{ \Carbon\Carbon::parse($user->updated_at)->format('d M Y') }}</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="d-flex align-items-center">
                                                <div class="me-3">
                                                    <div class="icon-circle bg-warning-light">
                                                        <i class="fas fa-shield-alt text-warning"></i>
                                                    </div>
                                                </div>
                                                <div>
                                                    <h6 class="text-muted small mb-1">Status</h6>
                                                    <p class="fw-bold mb-0">
                                                        @if ($user->email_verified_at)
                                                            <span
                                                                class="badge bg-success rounded-pill px-3 py-1">Verified</span>
                                                        @else
                                                            <span
                                                                class="badge bg-warning rounded-pill px-3 py-1">Pending</span>
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="d-flex align-items-center">
                                                <div class="me-3">
                                                    <div class="icon-circle bg-primary-light">
                                                        <i class="fas fa-user-check text-primary"></i>
                                                    </div>
                                                </div>
                                                <div>
                                                    <h6 class="text-muted small mb-1">Aktivitas</h6>
                                                    <p class="fw-bold mb-0">
                                                        <span class="badge bg-success rounded-pill px-3 py-1">Active</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Attendance Records Section -->
                <div class="card border-0 shadow-lg" style="border-radius: 20px;">
                    <div class="card-header bg-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="fw-bold mb-0 text-gradient"
                                style="background: linear-gradient(135deg, #A86523 0%, #E9A319 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                                Riwayat Absensi
                            </h5>
                            <div class="d-flex">
                                <div class="input-group input-group-sm me-2" style="width: 200px;">
                                    <span class="input-group-text bg-transparent"><i class="fas fa-calendar-alt"></i></span>
                                    <input type="text" class="form-control datepicker" placeholder="Filter tanggal">
                                </div>
                                <button class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-filter me-1"></i> Filter
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="timeline">
                            @foreach ($attendances as $attendance)
                                @php
                                    // Parse created_at to get date and time
                                    $date = \Carbon\Carbon::parse($attendance['created_at']);
                                    $time = $date->format('H:i:s');
                                    $formattedDate = $date->isoFormat('D MMMM YYYY');

                                    // Determine status and styling
                                    $isLate = str_contains($attendance['status'], 'terlambat');
                                    $badgeClass = $isLate ? 'bg-warning text-dark' : 'bg-success';
                                    $badgeText = $isLate ? 'Terlambat' : 'Hadir';
                                    $iconClass = $isLate ? 'fas fa-clock' : 'fas fa-check';
                                    $timelineBadgeClass = $isLate ? 'warning' : 'success';

                                    // Extract late duration if available
                                    $lateDuration = '';
                                    if ($isLate) {
                                        preg_match('/\((.+)\)/', $attendance['status'], $matches);
                                        $lateDuration = $matches[1] ?? '';
                                    }
                                @endphp

                                <div class="timeline-item">
                                    <div class="timeline-badge {{ $timelineBadgeClass }}">
                                        <i class="{{ $iconClass }}"></i>
                                    </div>
                                    <div class="timeline-card">
                                        <div class="timeline-header">
                                            <span class="badge {{ $badgeClass }} rounded-pill">{{ $badgeText }}</span>
                                            @if ($isLate)
                                                <span class="badge bg-danger rounded-pill ms-2">Telat:
                                                    {{ $lateDuration }}</span>
                                            @endif
                                            <span class="timeline-date">{{ $formattedDate }}</span>
                                        </div>
                                        <div class="timeline-content">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="timeline-info">
                                                        <i class="fas fa-sign-in-alt"></i>
                                                        <p><strong>Masuk:</strong></p>
                                                        <p style="margin-left: 10px">{{ $time }}</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="timeline-info">
                                                        <i class="fas fa-sign-out-alt"></i>
                                                        <strong>Keluar:</strong> -
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="timeline-info">
                                                        <i class="fas fa-map-marker-alt"></i>
                                                        <strong>Lokasi:</strong> -
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="timeline-notes mt-2">
                                                <i class="fas fa-sticky-note"></i> <strong>Status:</strong>
                                                {{ $attendance['status'] }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="text-center mt-4">
                            <a href="{{ route('absensi.index') }}" class="btn rounded-pill px-4"
                                style="border-color: #E9A319; color: #E9A319;">
                                <i class="fas fa-arrow-left me-2"></i> Kembali ke Absensi
                            </a>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>
@endsection



@section('script')
    <script>
        // You can add JavaScript for datepicker initialization here
        $(document).ready(function() {
            $('.datepicker').datepicker({
                format: 'dd-mm-yyyy',
                autoclose: true,
                todayHighlight: true
            });
        });
    </script>
@endsection
