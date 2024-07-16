@extends('layouts.main')

@section('main')
    {{-- @dd($user) --}}
    <h3 class="mb-4">Profil Saya</h3>
    <div class="row">
        <div class="col-lg-2 mb-3">
            <img src="{{ $user->pictureURL() }}" class="user-picture shadow img-fluid w-100 rounded-circle mb-3">
            <div class="text-center">
                <button data-url="{{ route('profile.removePicture') }}" type="button" id="profile-delete-picture-btn"
                    class="btn btn-sm btn-danger material-icons">delete</button>
                <button type="button" data-bs-toggle="modal" data-bs-target="#changeUserPictureModal"
                    class="btn btn-sm btn-success material-icons">edit</button>
            </div>
        </div>
        <div class="col-lg-10 mb-3">
            <table class="table table-borderless">
                <tr>
                    <td>Nomor Induk Siswa</td>
                    <td>
                        <input type="text" class="form-control" disabled value="{{ $user->username }}">
                    </td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td>
                        <input type="text" class="form-control" disabled value="{{ $user->name }}">
                    </td>
                </tr>
                <tr>
                    <td>Tanggal Lahir</td>
                    <td>
                        <input type="text" class="form-control" disabled
                            value="{{ '' ?? $user->date_of_bird->format('d F Y') }}">
                    </td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>
                        <textarea class="form-control" disabled rows="3">{{ $user->address }}</textarea>
                    </td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>
                        <input type="email" class="form-control" disabled value="{{ $user->email }}">
                    </td>
                </tr>
                <tr>
                    <td>Nomor Handphone</td>
                    <td>
                        <input type="text" class="form-control" disabled value="{{ $user->NoHandphone }}">
                    </td>
                </tr>
            </table>
            <div class="text-end">
                <a href="{{ route('profile.changePassword') }}" class="btn btn-dark btn-sm">Ubah Password</a>
                <a href="{{ route('profile.edit') }}" class="btn btn-dark btn-sm">Edit Profil</a>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        @role('member')
            <div class="col-lg-4 mb-3">
                <a href="{{ route('profile.borrowings') }}" class="text-decoration-none">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex h-100 justify-content-between align-items-center">
                                <div>
                                    <span class="material-icons card-icon text-danger">
                                        backpack
                                    </span>
                                </div>
                                <div class="text-end">
                                    <h5 class="mb-0 text-danger">Buku Yang Dipinjam</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
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
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-dark">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
        })
    </script>
@endsection
