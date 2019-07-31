@extends('layouts.privata')

@section('content')

    <!-- mostra di eventuali messaggi -->
    @if (session('errore'))
        <div class="alert alert-danger">{{ session('errore') }}</div>
    @else
        <div class="alert alert-success">{{ session('successo') }}</div>
    @endif

    <form action="{{ route('soci.destroy', $tessera->id) }}" method="POST"></form>




            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <a class="btn btn-small btn-primary" href="{{ URL::to('soci/') }}">Torna indietro</a>
            </div>
@endsection