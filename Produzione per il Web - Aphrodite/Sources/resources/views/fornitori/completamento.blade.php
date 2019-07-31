@extends('layouts.privata')

@section('content')

            <!-- Eventuale messaggio di errore -->
            @if (Session::has('messaggio'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
            @endif

            <h2>SUCCESSO!</h2>
            <h3>Hai completato l'iscrizione di un nuovo fornitore. <br></h3>
            <a class="btn btn-small btn-primary" href="{{ URL::to('fornitori/') }}">Torna alla home</a>

@endsection