@extends('layouts.corsi')

@section('content_corsi')


    <!-- Eventuale messaggio di errore -->
    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif

    <h1><center>Lista dei pacchetti</center></h1>
    <a class="btn btn-primary" style="background-color: #1f6fb2" href="{{ URL::to('pacchetti/create') }}">Aggiungi un pacchetto</a>

    <table class="table table-striped table-bordered">
                <thead style="background-color: #3f9ae5; color: white">
                <tr>
                    <td>NOME</td>
                    <td>PREZZO</td>
                </tr>
                </thead>
                <tbody style="background-color: #3bb9ff;">
                @foreach($lista_pacchetti as $valore)
                    <tr>
                        <td><b>{{ $valore->nome }}</b></td>
                        <td><b>{{ number_format($valore->prezzo, 2) }} €</b></td>

                        <!-- Bottone per mostrare il pscchetto-->
                        <td>
                            <a class="btn btn-small btn-success" style="background-color: #1f6fb2" href="{{ URL::to('pacchetti/' . $valore->id) }}">Mostra il pacchetto</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

@endsection