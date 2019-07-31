@extends('layouts.privata')

@section('content')

    <H2>SUCCESSO!</H2>
    <h3>Il pacchetto del socio è stato rinnovato per un mese a partire dalla data odierna al costo di {{$prezzo}} euro.<br><br>
            Per scaricare il documento correlato al pagamento del rinnovo della tessera visiona la sezione sottostante<br></h3>

            <table class="table table-striped table-bordered">
                <thead style="background-color: #3f9ae5; color: white">
                <tr>
                    <td>NOME DOCUMENTO</td>
                    <td>DESCRIZIONE</td>
                </tr>
                </thead>
                <tbody style="background-color: #3bb9ff; ">
                <tr>
                    <td>Ricevuta del pagamento effettuato</td>
                    <td>Documento per la ricevuta del pagamento effettuato dal socio per il rinnovo della tessera</td>
                    <td>
                        <a class="btn btn-small btn-success" href="ricevuta_pagamento">Scarica</a>
                    </td>
                </tr>
                </tbody>
            </table>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <a class="btn btn-small btn-primary" href="{{ URL::to('soci/') }}">Torna indietro</a>
            </div>

@endsection