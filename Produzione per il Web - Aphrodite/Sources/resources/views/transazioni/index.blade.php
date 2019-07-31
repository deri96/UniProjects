@extends('layouts.privata')

@section('content')

    <!-- Eventuale messaggio di errore -->
    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif



    <h1><center>Lista delle transazioni</center></h1><br>
    <a class="btn btn-primary" style="background-color: #1f6fb2" href="{{ URL::to('ricerca') }}">Ricerca una transazione</a>




    <table class="table table-striped table-bordered">
        <thead style="background-color: #3f9ae5; color: white">
        <tr>
            <td>NUMERO TRANSAZIONE</td>
            <td>IMPORTO</td>
            <td>DATA EROGAZIONE</td>
            <td>STATO</td>
        </tr>
        </thead>
        <tbody style="background-color: #3bb9ff; ">
        @foreach($lista_transazioni as $valore)
            <tr>
                <td><b>{{ $valore->numero_documento_fiscale }}</b></td>
                <td><b>{{ $valore->importo }}€</b></td>
                <td><b>{{ date('d-m-Y', strtotime($valore->data_erogazione)) }}</b></td>
                @if ($valore->in_entrata == 1)
                    <td><b>In entrata</b></td>
                @else
                    <td><b>In uscita</b></td>
                @endif


                <!-- Bottone per mostrare la transazione-->
                <td>
                    <a class="btn btn-small btn-success" style="background-color: #1f6fb2" href="{{ URL::to('transazioni/' . $valore->numero_documento_fiscale) }}">Mostra la transazione</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection