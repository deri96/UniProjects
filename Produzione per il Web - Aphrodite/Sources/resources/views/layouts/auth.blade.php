<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="Images/logo1.png">
    <title>ASD Aphrodite</title>
    <title>{{ config('app.name', 'ASD Aphrodite') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body style="background: #bcc6cc">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel"  style="background: #bcc6cc">
            <div class="row" style="margin-bottom: 5vh;">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><img src="Images/logo1.png" width="80" style=" margin-left: 45vw"></div>
            </div>
        </nav>
    </div>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
