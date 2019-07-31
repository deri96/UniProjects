@extends('layouts.privata')

@section('content')

<div class="jumbotron text-center">
<h1>RISULTATO DELLA RICERCA</h1><br>
    @foreach($risultato as $result)
    <h2>Numero transazione: {{ $result->numero_documento_fiscale }}</h2>
    <p>
        <strong>Tipo di documento rilasciato:</strong> {{ $result->tipo_documento_fiscale }}<br>
        <strong>Importo:</strong> {{ number_format($result->importo, 2) }}€<br>
        <strong>Causale:</strong> {{ $result->causale }}<br>
        <strong>Data  di erogazione:</strong> {{ date('d-m-Y', strtotime($result->data_erogazione)) }}<br>
        <strong>Modalità di pagamento:</strong> {{ $result->modalita_pagamento}}<br>
        @if ($result->in_entrata == 1)
            <strong>Tipo di transazione:</strong> In entrata<br>
        @else
            <strong>Tipo di transazione:</strong> In uscita<br>
        @endif
        @if ($result->codice_fiscale_soggetto_transazione != NULL)
            <strong>Codice fiscale del soggetto:</strong> {{$result->codice_fiscale_soggetto_transazione}}<br>
        @endif
        @if ($result->partita_iva_soggetto_transazione_id != NULL)
            <strong>Partita IVA del soggetto:</strong> {{$result->partita_iva_soggetto_transazione_id}}<br>
        @endif
    </p><br>
    @endforeach
    <a class="btn btn-small btn-primary" href="{{ URL::to('transazioni/') }}">Torna alla lista</a>
</div>
@endsection