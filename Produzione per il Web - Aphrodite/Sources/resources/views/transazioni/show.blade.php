@extends('layouts.privata')

@section('content')

    <h1>Stampa delle informazioni sulle transazioni</h1>

    <div class="jumbotron text-center">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                <a class="btn btn-small btn-primary" href="{{ URL::to('transazioni/') }}">Torna alla lista</a>
            </div>
            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                <h2>Transazione {{ $transazione->numero_documento_fiscale }}</h2>
                <p>
                    <strong>Tipo Documento Fiscale:</strong> {{ $transazione->tipo_documento_fiscale }}<br>
                    <strong>Importo:</strong> {{ $transazione->importo }}€<br>
                    <strong>Causale:</strong> {{ $transazione->causale }}<br>
                    <strong>Data Erogazione:</strong> {{ $transazione->data_erogazione }}<br>
                    <strong>Modalità Pagamento:</strong> {{ $transazione->modalita_pagamento}}<br>
                    @if ($transazione->in_entrata == 1)
                        <strong>Stato:</strong> In Entrata<br>
                    @else
                        <strong>Stato:</strong> In Uscita<br>
                    @endif
                    @if ($transazione->codice_fiscale_soggetto_transazione != NULL)
                        <strong>Codice Fiscale Soggetto Transazione:</strong> {{$transazione->codice_fiscale_soggetto_transazione}}<br>
                    @endif

                    @if ($transazione->partita_iva_soggetto_transazione_id != NULL)
                        <strong>Partita IVA Soggetto Transazione:</strong> {{$transazione->partita_iva_soggetto_transazione_id}}<br>
                    @endif
                </p>
            </div>
        </div>
    </div>
@endsection