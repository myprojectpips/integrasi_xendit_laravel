<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="{{ mix('js/app.js') }}"></script>

    <link rel="stylesheet" href="/loading.css">
    <script src="/jquery.js"></script>
</head>
<body class="bg-light">
    <div id="background-loading">
        <span class="loading-text">LOADING</span>
        <div class="loader"></div>
    </div>

    <div class="container">
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark mb-5 mt-5">
            <div class="container-fluid">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('index') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('index.ewallet') }}">Ewallet</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('index.va') }}">Virtual Account</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('index.qrCode') }}">QR Code</a>
                </li>
            </ul>
            </div>
        </nav>

        @yield('content')
    </div>

    <script>
        $(window).load(function(){
            $('#background-loading').fadeOut("slow");
        });
    </script>
</body>
</html>