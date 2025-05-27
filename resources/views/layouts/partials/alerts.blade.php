{{-- @if (session('info'))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        {!! session('info') !!}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {!! session('success') !!}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (session('warning'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {!! session('warning') !!}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (session('danger'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {!! session('danger') !!}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if ($errors->any())
    <div class="pb-0 alert alert-danger alert-dismissible fade show" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{!! $error !!}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (session('status'))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        {!! session('status') !!}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif --}}





<script>
    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            html: `{!! session('success') !!}`,
            timer: 3000,
            showConfirmButton: false
        });
    @endif

    @if (session('info'))
        Swal.fire({
            icon: 'info',
            title: 'Informasi',
            html: `{!! session('info') !!}`,
            timer: 3000,
            showConfirmButton: false
        });
    @endif

    @if (session('warning'))
        Swal.fire({
            icon: 'warning',
            title: 'Peringatan',
            html: `{!! session('warning') !!}`,
            timer: 3000,
            showConfirmButton: false
        });
    @endif

    @if (session('danger'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            html: `{!! session('danger') !!}`,
            timer: 3000,
            showConfirmButton: false
        });
    @endif

    @if ($errors->any())
        Swal.fire({
            icon: 'error',
            title: 'Terjadi Kesalahan',
            html: `<ul style="text-align:left;">@foreach ($errors->all() as $error)<li>{!! $error !!}</li>@endforeach</ul>`,
            showConfirmButton: true
        });
    @endif

    @if (session('status'))
        Swal.fire({
            icon: 'info',
            title: 'Status',
            html: `{!! session('status') !!}`,
            timer: 3000,
            showConfirmButton: false
        });
    @endif
</script>
