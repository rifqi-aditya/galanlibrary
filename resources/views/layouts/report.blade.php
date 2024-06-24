<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito Sans', sans-serif;
        }

        div.content {
            max-width: 980px;
            margin: 0 auto;
        }

        div.header h5 {
            margin: 20px auto 10px auto;
        }

        div.header h2,
        div.header h4,
        div.header p {
            margin: 0 auto 10px auto;
        }

        div.data table {
            width: 100%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        div.data table th,
        div.data table td {
            border: 1px solid black;
            padding: 8px;

        }

        @media print {
            div.content {
                width: 100%;
                margin: 0 auto;
            }
        }

    </style>
    <title>Laporan</title>
</head>

<body>
    @yield('main')
</body>

</html>
