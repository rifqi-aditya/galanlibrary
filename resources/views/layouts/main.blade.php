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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>
    <style>
        .love-checkbox {
            display: none;
        }

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
    </style>
<body class="nunito">
    @include('layouts.partials.navbar')
    <main class="container col-lg-8 py-lg-5 py-3">
        @include('layouts.partials.alerts')
        @yield('main')
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
    @yield('script')
</body>

</html>
