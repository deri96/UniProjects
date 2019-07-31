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
    <script src="{{ asset('js/main.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
</head>
<body style="background: #bcc6cc">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel"  style="background: #bcc6cc">
            <ul class="navbar-nav mr-auto">
                <li>
                    <a href="{{URL::to('home')}}"><img src="Images/logo1.png" width="80" style=" margin-left: 20px"></a>
                </li>
            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item" style="background: #357ec7; font-size: 1.5vw;">
                        <strong><a class="nav-link" href="{{ route('login') }}" style="color: #ffffff">{{ __('AREA RISERVATA') }}</a></strong>
                    </li>

                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </nav>

        <nav class="navbar navbar-expand-md navbar-light navbar-laravel" style="background: #7fe817">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->

                    <div class="row" style="margin-left: 2vw;">
                        <div class ="col-lg-2 col-md-2 col-sm-2 col-xs-2"><a href="{{ URL::to('home') }}" style="font-size:2vw; margin-left: -6vw;"><img src="icon/HomeN.png" width="55%"></a></div>
                        <div class ="col-lg-2 col-md-2 col-sm-2 col-xs-2"><a href="{{ URL::to('chisiamo') }}"style="font-size:2vw; margin-left: -8vw;"><img src="icon/ChiSiamoN.png" width="100%"></a></div>
                        <div class ="col-lg-2 col-md-2 col-sm-2 col-xs-2"><a href="{{ URL::to('listacorsi') }}"style="font-size:2vw; margin-left: -3vw; "><img src="icon/CorsiN.png" width="120%"></a></div>
                        <div class ="col-lg-2 col-md-2 col-sm-2 col-xs-2"><a href="{{ URL::to('avvisi') }}"style="font-size:2vw; margin-left: 5vw; "><img src="icon/AvvisiN.png" width="150%"></a></div>
                        <div class ="col-lg-2 col-md-2 col-sm-2 col-xs-2"><a href="{{ URL::to('contatti') }}"style="font-size:2vw; margin-left: 16vw; "><img src="icon/ContattiN.png" width="100%"></a></div>
                    </div>

                </div>
            </div>
            </div>
        </nav>
    </div>


        <main class="py-4">
            @yield('content')
        </main>

</body>

</html>
<style>
    body {
        font-size: 1.5vw;
    }
</style>