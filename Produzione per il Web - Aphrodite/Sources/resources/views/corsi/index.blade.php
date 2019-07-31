@extends('layouts.corsi')

@section('content_corsi')

    <!-- Eventuale messaggio di errore -->
    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif

            <h1><center>Lista dei corsi</center></h1><br>
            <a class="btn btn-primary" style="background-color: #1f6fb2" href="{{ URL::to('corsi/create') }}">Aggiungi un corso</a>

            <table class="table table-striped table-bordered">
                <thead style="background-color: #3f9ae5; color: white">
                <tr>
                    <td>NOME CORSO</td>
                    <td>COSTO ORARIO</td>
                </tr>
                </thead>
                <tbody style="background-color: #3bb9ff;">
                @foreach($lista_corsi as $valore)
                    <tr>
                        <td><b>{{ $valore->nome }}</b></td>
                        <td><b>{{ number_format($valore->costo, 2) }} €</b></td>

                        <!-- Bottone per mostrare lo stagista-->
                        <td>
                            <a class="btn btn-small btn-success" style="background-color: #1f6fb2" href="{{ URL::to('corsi/' . $valore->id) }}">Mostra il corso</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

@endsection