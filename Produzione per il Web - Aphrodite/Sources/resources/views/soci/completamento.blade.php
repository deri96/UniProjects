@extends('layouts.privata')

@section('content')

    <!-- Eventuale messaggio di errore -->
    @if (Session::has('messaggio'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif
    @if($password_in_chiaro != '0')
        <H2>SUCCESSO!</H2>
    <h3>Hai completato l'iscrizione di un nuovo socio.<br>
        @if ($inaccessibile == 0)
            Prendi nota della password: <b>{{$password_in_chiaro}}</b>. Ti servirà per accedere all'area riservata.<br><br>
        @endif
    Per scaricare i documenti correlati al nuovo socio visiona la sezione sottostante<br>
        <strong>N.B.</strong> I moduli non sono compilati automaticamente, assicurati di avere tutte le informazioni
        che ti servono per compilarli a mano</h3>

    <table class="table table-striped table-bordered">
        <thead style="background-color: #3f9ae5; color: white">
        <tr>
            <td>NOME DOCUMENTO</td>
            <td>DESCRIZIONE</td>
        </tr>
        </thead>
        <tbody style="background-color: #3bb9ff; ">
            <tr>
                <td>Modulo di iscrizione</td>
                <td>Documento per l'iscrizione di un nuovo socio con la relativa liberatoria
                per l'uso delle immagini e dei dati personali</td>
                <td>
                    <a class="btn btn-small btn-success" style="background-color: #1f6fb2" href="{{ route('modulo_iscrizione')}}">Scarica</a>
                </td>
            </tr>
            <tr>
                <td>Ricevuta del pagamento effettuato</td>
                <td>Documento per la ricevuta del pagamento effettuato dal nuovo socio</td>
                <td>
                    <a class="btn btn-small btn-success" style="background-color: #1f6fb2" href="{{route('ricevuta_pagamento')}}">Scarica</a>
                </td>
            </tr>
            <tr>
                <td>Modulo di iscrizione per i minorenni</td>
                <td>Documento per l'iscrizione di un nuovo socio minorenne </td>
                <td>
                    <a class="btn btn-small btn-success" style="background-color: #1f6fb2" href="{{route('ricevuta_iscrizione_minorenne')}}">Scarica</a>
                </td>
            </tr>
            <tr>
                <td>Richiesta di iscrizione al consiglio</td>
                <td>Documento per la richiesta di iscrizione del nuovo socio al consiglio direttivo
                della società</td>
                <td>
                    <a class="btn btn-small btn-success" style="background-color: #1f6fb2" href="{{route('richiesta_iscrizione_consiglio_direttivo')}}">Scarica</a>
                </td>
            </tr>
        </tbody>
    </table>
    @else
        <H2>SUCCESSO!</H2>
        <h3>Hai completato la transazione.<br>
            @if (isset($prezzo))
                L'importo pagato e definito nella transazione è di {{$prezzo}} euro.<br>
            @endif
            Per scaricare i documenti correlati alla transazione visiona la sezione sottostante<br><br>
            <strong>N.B.</strong> I moduli non sono compilati automaticamente, assicurati di avere tutte le informazioni
            che ti servono per compilarli a mano</h3>

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
                <td>Documento per la ricevuta del pagamento effettuato</td>
                <td>
                    <a class="btn btn-small btn-success" style="background-color: #1f6fb2" href="{{route('ricevuta_pagamento')}}">Scarica</a>
                </td>
            </tr>
            </tbody>
        </table>
    @endif

    <a class="btn btn-small btn-primary" href="{{ URL::to('area_riservata') }}">Torna alla home</a>

@endsection