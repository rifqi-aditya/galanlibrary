@extends('layouts.main')

@section('main')
    <div class="container py-4">
        <h3 class="mb-4">Profil Saya</h3>

        <div class="row justify-content-center">
            <div class="col-md-3 mb-4 text-center">
                <img src="{{ $user->pictureURL() }}" class="user-picture shadow img-fluid rounded-circle mb-3"
                    style="width: 180px; height: 180px; object-fit: cover;">
                <div class="d-flex justify-content-center gap-2">
                    <button data-url="{{ route('profile.removePicture') }}" type="button" id="profile-delete-picture-btn"
                        class="btn btn-sm btn-danger material-icons">delete</button>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#changeUserPictureModal"
                        class="btn btn-sm btn-success material-icons">edit</button>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <table class="table table-borderless">
                            @if (!auth()->user()->hasRole('administrator'))
                                <tr>
                                    <td width="30%">Nomor Induk Siswa</td>
                                    <td>
                                        <input type="text" class="form-control" disabled value="{{ $user->nis }}">
                                    </td>
                                </tr>
                            @endif
                            <tr>
                                <td>Nama</td>
                                <td>
                                    <input type="text" class="form-control" disabled value="{{ $user->name }}">
                                </td>
                            </tr>
                            @if (!auth()->user()->hasRole('administrator'))
                                <tr>
                                    <td>Tanggal Lahir</td>
                                    <td>
                                        <input type="text" class="form-control" disabled
                                            value="{{ isset($user->date_of_birth) ? $user->date_of_birth->format('d F Y') : '' }}">
                                    </td>
                                </tr>
                            @endif
                            @if (!auth()->user()->hasRole('administrator'))
                                <tr>
                                    <td>Alamat</td>
                                    <td>
                                        <textarea class="form-control" disabled rows="3">{{ $user->address }}</textarea>
                                    </td>
                                </tr>
                            @endif
                            <tr>
                                <td>Email</td>
                                <td>
                                    <input type="email" class="form-control" disabled value="{{ $user->email }}">
                                </td>
                            </tr>
                            @if (!auth()->user()->hasRole('administrator'))
                                <tr>
                                    <td>Nomor Handphone</td>
                                    <td>
                                        <input type="text" class="form-control" disabled
                                            value="{{ $user->NoHandphone }}">
                                    </td>
                                </tr>
                            @endif
                        </table>

                        <!-- Barcode Section - Moved here to center it -->
                        @role('administrator')
                            <div class="text-center my-5">
                                <div class="card shadow-lg p-4 mx-auto" style="max-width: 400px; border-radius: 12px;">
                                    <div class="card-body">
                                        <h5 class="card-title mb-3">Kartu Admin Perpustakaan</h5>

                                        <div style="display: flex; justify-content: center;">
                                            <div class="bg-white p-3 mb-3 rounded" style="border: 1px solid #eee;">
                                                {!! DNS2D::getBarcodeHTML($user->barcode, 'QRCODE', 8, 8) !!}
                                            </div>
                                        </div>

                                        <p class="text-muted small mb-4">Scan barcode untuk verifikasi keanggotaan</p>


                                    </div>
                                </div>
                            </div>
                        @endrole

                        <div class="d-flex justify-content-end gap-2 mt-3">
                            <a href="{{ route('profile.changePassword') }}" class="btn btn-dark btn-sm">Ubah Password</a>
                            <a href="{{ route('profile.edit') }}" class="btn btn-dark btn-sm">Edit Profil</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr class="my-4">

        @role('member')
            <div class="row">
                <div class="col-md-4 mb-3">
                    <a href="{{ route('profile.borrowings') }}" class="text-decoration-none">
                        <div class="card shadow-sm h-100 hover-effect">
                            <div class="card-body">
                                <div class="d-flex align-items-center gap-3">
                                    <span class="material-icons card-icon text-danger" style="font-size: 2.5rem;">
                                        backpack
                                    </span>
                                    <h5 class="mb-0 text-danger">Buku Yang Dipinjam</h5>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        @endrole
    </div>

    <!-- Modal -->
    <div class="modal fade" id="changeUserPictureModal" tabindex="-1" aria-labelledby="changeUserPictureModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changeUserPictureModalLabel">Ubah Foto Profil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('profile.changePicture') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="file" name="picture" class="form-control" required>
                        <small class="text-muted">Format: JPG, PNG (Max 2MB)</small>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-outline-secondary"
                            data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-sm btn-dark">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .hover-effect {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .hover-effect:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .card-icon {
            font-size: 2rem;
        }

        .form-control:disabled {
            background-color: #f8f9fa;
            border-color: #e9ecef;
        }

        textarea.form-control:disabled {
            resize: none;
        }

        /* Barcode styling */
        .barcode-container {
            background: white;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin: 0 auto;
            max-width: 200px;
        }

        .barcode-title {
            color: #333;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .barcode-footer {
            font-size: 0.8rem;
            color: #6c757d;
            margin-top: 8px;
        }
    </style>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            let deletePictureBtn = document.getElementById('profile-delete-picture-btn');
            let userPictures = document.querySelectorAll('img.user-picture')
            deletePictureBtn.addEventListener('click', () => {
                if (confirm(
                        'Hapus foto profil? Foto dari gravatar akan digunakan setelah foto profil dihapus.'
                    )) {
                    $.ajax({
                        type: "post",
                        url: "{{ route('profile.removePicture') }}",
                        data: {
                            _token: "{{ csrf_token() }}",
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.success) {
                                userPictures.forEach((picture, index) => {
                                    picture.setAttribute('src', response
                                        .defaultPictureURL)
                                })
                            }
                        }
                    })
                }
            })
        });

        function downloadBarcode() {
            // Create a canvas element
            const canvas = document.createElement('canvas');
            const size = 300; // Size of the QR code
            canvas.width = size;
            canvas.height = size;

            // Get the QR code SVG element
            const svg = document.querySelector('svg');

            // Draw the SVG on canvas
            const ctx = canvas.getContext('2d');
            const img = new Image();
            const svgData = new XMLSerializer().serializeToString(svg);
            const url = 'data:image/svg+xml;base64,' + btoa(unescape(encodeURIComponent(svgData)));

            img.onload = function() {
                ctx.drawImage(img, 0, 0, size, size);

                // Convert canvas to image and download
                const link = document.createElement('a');
                link.download = 'barcode-{{ $user->name }}.png';
                link.href = canvas.toDataURL('image/png');
                link.click();
            };

            img.src = url;
        }
    </script>
@endsection
