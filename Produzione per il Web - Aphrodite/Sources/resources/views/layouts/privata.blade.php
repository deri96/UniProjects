<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
<body style="background: #bcc6cc; ">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel"  style="background: #bcc6cc">
            <ul class="navbar-nav mr-auto">
                <li>
                    <a href="{{URL::to('area_riservata')}}"><img src="{{URL::asset('Images/logo1.png')}}" width="80" style=" margin-left: 20px"></a>
                </li>
            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item" style="background: #4AA02C; font-size: 1.5vw;">
                        <strong><a class="nav-link" href="{{ route('login') }}" style="color: #000000">{{ __('LOGOUT') }}</a></strong>
                    </li>

                @else
                    <li class="nav-item" style="background: #4AA02C; font-size: 1.5vw;">
                        <strong><a class="nav-link" href="{{ URL::to('home') }}" style="color: #000000">{{ __('LOGOUT') }}</a></strong>
                    </li>
                @endguest
            </ul>
        </nav>
    </div>
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel" style="background: #3bb9ff">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <div class="row">
                        @if (auth()->user()->tipo_admin == 'admin')
                            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"><a href="{{ route('soci.index') }}"><center><img src="{{URL::asset('icon/Soci.png')}}" style="width: 50%; height: 70%"></center></a></div>
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"><a href="{{ route('fornitori.index') }}"><center><img src="{{URL::asset('icon/Fornitori.png')}}" style="width: 100%; height: 80%"></center></a></div>
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"><a href="{{ route('stagisti.index') }}"><center><img src="{{URL::asset('icon/Stagisti.png')}}" style="width: 80%; height: 80%"></center></a></div>
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"><a href="{{ route('corsi.index') }}"><center><img src="{{URL::asset('icon/Corsi.png')}}" style="width: 60%; height: 70%"></center></a></div>
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"><a href="{{ route('transazioni.index') }}"><center><img src="{{URL::asset('icon/Transazioni.png')}}" style="width: 120%; height: 90%"></center></a></div>
                            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>
                        @elseif (auth()->user()->tipo_admin == 'admin_utente')
                            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"><a href="{{ route('soci.index') }}"><center><img src="{{URL::asset('icon/Soci.png')}}" style="width: 100%; height: 100%"></center></a></div>
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"><a href="{{ route('fornitori.index') }}"><center><img src="{{URL::asset('icon/Fornitori.png')}}" style="width: 100%; height: 80%"></center></a></div>
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"><a href="{{ route('stagisti.index') }}"><center><img src="{{URL::asset('icon/Stagisti.png')}}" style="width: 80%; height: 80%"></center></a></div>
                            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"><a href="{{ route('corsi.index') }}"><center><img src="{{URL::asset('icon/Corsi.png')}}" style="width: 120%; height: 100%"></center></a></div>
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"><a href="{{ route('transazioni.index') }}"><center><img src="{{URL::asset('icon/Transazioni.png')}}" style="width: 105%; height: 90%"></center></a></div>
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"><a href="{{ route('lista_corsi', auth()->user()->tessera_id) }}"><center><img src="{{URL::asset('icon/CorsiB.png')}}" style="width: 90%; height: 90%"></center></a></div>
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"><a href="{{ route('calendario_corsi', auth()->user()->tessera_id) }}"><center><img src="{{URL::asset('icon/Calendario.png')}}" style="width: 100%; height: 90%"></center></a></div>
                        @elseif (auth()->user()->tipo_admin == 'utente')
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><a href="{{ route('lista_corsi', auth()->user()->tessera_id) }}"><center><img src="{{URL::asset('icon/CorsiB.png')}}" style="width: 70%; height: 90%"></center></a></div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><a href="{{ route('calendario_corsi', auth()->user()->tessera_id) }}"><center><img src="{{URL::asset('icon/Calendario.png')}}" style="width: 70%; height: 90%"></center></a></div>
                        @endif
                    </div>
                </div>
                </div></div>
        </nav>

        <main class="py-4">
            <div class="container" style="font-size: 1.5vw">
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
<style>
    body {
        font-size: 1.5vw;
    }
</style>
