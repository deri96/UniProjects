@extends('layouts.privata')

@section('content')


    <!-- Eventuale messaggio di errore -->
            @if (Session::has('messaggio'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
            @endif

            <h2>SUCCESSO!</h2>
            Hai completato l'iscrizione di un nuovo stagista. <br>
            <a class="btn btn-small btn-primary" href="{{ URL::to('stagisti/') }}">Torna alla home</a>

@endsection