@extends('layouts.privata')

@section('content')

    <!-- Eventuale messaggio di errore -->
    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif

    <h1><center>Lista dei fornitori</center></h1><br>
    <a class="btn btn-primary" style="background-color: #1f6fb2" href="{{ URL::to('fornitori/create') }}">Aggiungi un fornitore</a>



            <table class="table table-striped table-bordered">
                <thead style="background-color: #3f9ae5; color: white">
                <tr>
                    <td>PARTITA IVA</td>
                    <td>NOME</td>
                    <td>TIPO FORNITURA</td>
                    <td>NUMERO TELEFONO</td>
                </tr>
                </thead>
                <tbody style="background-color: #3bb9ff; ">
                @foreach($lista_fornitori as $valore)
                    <tr>
                        <td><b>{{ $valore->partita_iva }}</b></td>
                        <td><b>{{ $valore->nome }}</b></td>
                        <td><b>{{ $valore->tipo_fornitura }}</b></td>
                        <td><b>{{ $valore->numero_telefono }}</b></td>

                        <!-- Bottone per mostrare il fornitore-->
                        <td>
                            <a class="btn btn-small btn-success" style="background-color: #1f6fb2" href="{{ URL::to('fornitori/' . $valore->partita_iva) }}">Mostra il fornitore</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
@endsection