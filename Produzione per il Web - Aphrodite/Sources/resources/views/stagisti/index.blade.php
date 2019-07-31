@extends('layouts.privata')

@section('content')

    <!-- Eventuale messaggio di errore -->
    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif

    <h1><center>Lista degli stagisti</center></h1><br>
    <a class="btn btn-primary" style="background-color: #1f6fb2" href="{{ URL::to('stagisti/create') }}">Aggiungi uno stagista</a>


    <table class="table table-striped table-bordered">
                <thead style="background-color: #3f9ae5; color: white">
                <tr>
                    <td>NOME</td>
                    <td>COGNOME</td>
                    <td>CODICE FISCALE</td>
                </tr>
                </thead>
                <tbody style="background-color: #3bb9ff; ">
                @foreach($lista_stagisti as $valore)
                    <tr>
                        <td><b>{{ $valore->nome }}</b></td>
                        <td><b>{{ $valore->cognome }}</b></td>
                        <td><b>{{ $valore->codice_fiscale }}</b></td>

                        <!-- Bottone per mostrare lo stagista-->
                        <td>
                            <a class="btn btn-small btn-success" style="background-color: #1f6fb2" href="{{ URL::to('stagisti/' . $valore->codice_fiscale) }}">Mostra lo stagista</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

@endsection