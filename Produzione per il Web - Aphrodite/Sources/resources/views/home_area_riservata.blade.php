@extends('layouts.privata')

@section('content')

    <br><br>
    <h1>Questa è l'area riservata del sistema dell'ASD Aphrodite</h1>
    <br><br>
    <h2>
    Le tue credenziali: <br><br>
    <strong>E-mail: </strong><br>{{ auth()->user()->email }}<br><br>
    <strong>Tipo di utente: <br></strong>
    @if (auth()->user()->tipo_admin == 'admin')
        Amministratore societario
    @elseif (auth()->user()->tipo_admin == 'admin_utente')
        Amministratore societario e socio ordinario allievo
    @elseif (auth()->user()->tipo_admin == 'utente')
        Socio ordinario alievo
    @endif
    </h2>
@endsection