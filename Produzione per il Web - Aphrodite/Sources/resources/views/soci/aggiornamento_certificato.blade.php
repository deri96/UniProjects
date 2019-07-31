@extends('layouts.privata')

@section('content')

    <h2>SUCCESSO!</h2>
    <h3>Il certificato medico del socio è stato aggiornato per una durata di sei mesi a partire dalla data odierna.</h3>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <a class="btn btn-small btn-primary" href="{{ URL::to('soci/') }}">Torna indietro</a>
            </div>
@endsection