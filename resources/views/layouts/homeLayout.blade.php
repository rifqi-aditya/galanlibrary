<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <title>
        @yield('title', 'E-Perpus')
    </title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,1,0" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    {{-- font --}}
     <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

    <style>
        .love-label {
            display: inline-block;
            width: 50px;
            height: 50px;
            position: relative;
            cursor: pointer;
            user-select: none;
        }

        .love-label::before,
        .love-label::after {
            content: "";
            width: 25px;
            height: 40px;
            background: #ccc;
            position: absolute;
            border-radius: 25px 25px 0 0;
            transition: all 0.3s ease;
        }

        .love-label::before {
            left: 25px;
            top: 0;
            transform: rotate(-45deg);
            transform-origin: 0 100%;
        }

        .love-label::after {
            left: 0;
            top: 0;
            transform: rotate(45deg);
            transform-origin: 100% 100%;
        }

        .love-checkbox:checked + .love-label::before,
        .love-checkbox:checked + .love-label::after {
            background: red;
        }

        .love-checkbox:checked + .love-label {
            animation: heartbeat 0.5s ease-in-out;
        }

        @keyframes heartbeat {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.2);
            }
        }
        .divider:after,
        .divider:before {
        content: "";
        flex: 1;
        height: 1px;
        background: #eee;
        }
        .h-custom {
        height: calc(100% - 73px);
        }
        @media (max-width: 450px) {
        .h-custom {
        height: 100%;
        }
        }
        .nav-link-2 {
         color: grey; /* Warna abu-abu muda saat tidak di-hover */
         text-decoration: none; /* Menghapus garis bawah jika diinginkan */
        }

        .nav-link-2:hover {
        color: black; /* Warna hitam saat di-hover */
        }

        .material-symbols-outlined {
        color: gray; /* Warna abu-abu saat tidak di-hover */
        }

        .material-symbols-outlined:hover {
        color: red; /* Warna merah saat di-hover */
        }
        body{
            font-family: 'Poppins', sans-serif;
        }
    </style>
<body >
    @include('layouts.partials.navbar')
    <main class=" col-lg-12">
        {{-- @include('layouts.partials.alerts') --}}
       <div style="min-height: 100vh">
         @yield('main')
       </div>
    </main>
    @include('layouts.partials.footer')
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js">
    </script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/custom.js') }}"></script>

    @if (session('info'))
    <script>
        Swal.fire({
            icon: 'success',
            title: '{!! session('info') !!}',
            showConfirmButton: true
        });
    </script>
    @endif

    @if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '{!! session('success') !!}',
            showConfirmButton: true
        });
    </script>
    @endif

    @if (session('warning'))
    <script>
        Swal.fire({
            icon: 'warning',
            title: 'Warning',
            text: '{!! session('warning') !!}',
            showConfirmButton: true
        });
    </script>
    @endif

    @if (session('danger'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '{!! session('danger') !!}',
            showConfirmButton: true
        });
    </script>
    @endif

    @if ($errors->any())
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            html: '<ul>{!! implode('', $errors->all('<li>:message</li>')) !!}</ul>',
            showConfirmButton: true
        });
    </script>
    @endif

    @if (session('status'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Status',
            text: '{!! session('status') !!}',
            showConfirmButton: true
        });
    </script>
    @endif

    @yield('script')
</body>

</html>
