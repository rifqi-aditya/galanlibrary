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
        @yield('title', 'Galan Library')
    </title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,1,0" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    {{-- font --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">


    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

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

    .love-checkbox:checked+.love-label::before,
    .love-checkbox:checked+.love-label::after {
        background: red;
    }

    .love-checkbox:checked+.love-label {
        animation: heartbeat 0.5s ease-in-out;
    }

    @keyframes heartbeat {

        0%,
        100% {
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
        color: grey;
        /* Warna abu-abu muda saat tidak di-hover */
        text-decoration: none;
        /* Menghapus garis bawah jika diinginkan */
    }

    .nav-link-2:hover {
        color: black;
        /* Warna hitam saat di-hover */
    }

    .material-symbols-outlined {
        color: gray;
        /* Warna abu-abu saat tidak di-hover */
    }

    .material-symbols-outlined:hover {
        color: red;
        /* Warna merah saat di-hover */
    }

    body {
        font-family: 'Poppins', sans-serif;
    }



    /* scanner */

    .bg-gradient-primary {
        background: linear-gradient(135deg, #3a7bd5 0%, #00d2ff 100%);
    }

    .bg-light-blue {
        background-color: #f8fbff;
    }

    .scanner-container {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .scanner-wrapper {
        position: relative;
        width: 100%;
        max-width: 500px;
        margin: 0 auto;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    #reader {
        width: 100%;
        height: 300px;
        background: #000;
        position: relative;
    }

    #reader::after {
        content: "Arahkan kamera ke barcode buku";
        position: absolute;
        bottom: 15px;
        left: 0;
        right: 0;
        color: white;
        text-align: center;
        font-size: 14px;
        padding: 8px;
        background: rgba(0, 0, 0, 0.5);
    }

    .scanline {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: rgba(58, 123, 213, 0.8);
        box-shadow: 0 0 10px rgba(58, 123, 213, 0.8);
        animation: scan 2.5s infinite linear;
        z-index: 10;
    }

    @keyframes scan {
        0% {
            top: 0;
        }

        100% {
            top: 100%;
        }
    }

    .corner {
        position: absolute;
        width: 30px;
        height: 30px;
        border-color: #3a7bd5;
        border-width: 4px;
        z-index: 9;
    }

    .corner.top-left {
        top: 10px;
        left: 10px;
        border-top-style: solid;
        border-left-style: solid;
        border-right: none;
        border-bottom: none;
    }

    .corner.top-right {
        top: 10px;
        right: 10px;
        border-top-style: solid;
        border-right-style: solid;
        border-left: none;
        border-bottom: none;
    }

    .corner.bottom-left {
        bottom: 10px;
        left: 10px;
        border-bottom-style: solid;
        border-left-style: solid;
        border-top: none;
        border-right: none;
    }

    .corner.bottom-right {
        bottom: 10px;
        right: 10px;
        border-bottom-style: solid;
        border-right-style: solid;
        border-top: none;
        border-left: none;
    }

    .guide-card {
        border: 1px solid rgba(58, 123, 213, 0.2);
    }

    .step-number {
        width: 24px;
        height: 24px;
        font-size: 12px;
        flex-shrink: 0;
    }

    .manual-card {
        border: 1px solid rgba(58, 123, 213, 0.2);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .form-control-lg {
        font-size: 1.1rem;
        padding: 12px 15px;
    }

    .btn-primary {
        background-color: #3a7bd5;
        border-color: #3a7bd5;
        transition: all 0.3s;
    }

    .btn-primary:hover {
        background-color: #2c65b4;
        border-color: #2c65b4;
        transform: translateY(-2px);
    }
</style>

<body>
    @include('layouts.partials.navbar')
    <main class=" col-lg-12">
        <div style="min-height: 100vh; padding-top: 50px; padding-left: 50px; padding-right: 50px">
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
    <script src="{{ asset('js/custom.js') }}"></script>

    {{-- sweet alert --}}

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @include('layouts.partials.alerts')





    @yield('script')
</body>

</html>
