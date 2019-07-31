@extends('layouts.privata')

@section('content')

    <h1>Stampa delle informazioni su {{ $fornitore->nome }}</h1>

            <div class="jumbotron text-center">
                <form action="{{route('fornitori.destroy', $fornitore->partita_iva)}}" method="POST">
                    <div class="row">
                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                            <a class="btn btn-small btn-primary" href="{{ URL::to('fornitori/') }}">Torna alla lista</a>

                            <strong><br><br>OPERAZIONI EFFETTUABILI</strong><br>
                            <a class="btn btn-small btn-block" style="color: #1b1e21" href="{{ route('transazione_fornitore', $fornitore->partita_iva) }}"><b> - Aggiungi una transazione al fornitore</b></a>

                            <a class="btn btn-small btn-block" style="color: #1b1e21" href="{{ URL::to('fornitori/' . $fornitore->partita_iva . '/edit') }}"><b> - Modifica il fornitore</b></a>
                            <br>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-small btn-danger">Elimina il fornitore</button>
                        </div>
                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                            <h2>{{ $fornitore->nome .", " .$fornitore->ragione_sociale}}</h2>
                            <p>
                                <strong>Partita IVA:</strong> {{ $fornitore->partita_iva }}<br>
                                <strong>Indirizzo:</strong> {{ $indirizzo->via ." N° " .$indirizzo->numero_civico .", " .$indirizzo->citta}}<br>
                                <strong>E-mail:</strong> {{ $fornitore->email }}<br>
                                <strong>Numero di telefono:</strong> {{ $fornitore->numero_telefono }}<br>
                                <strong>Tipo di fornitura:</strong> {{ $fornitore->tipo_fornitura }}<br>
                                @if ($fornitore->note != NULL)
                                    <strong>Note aggiuntive:</strong> {{ $fornitore->note }}<br>
                                @endif
                            </p>
                        </div>
                    </div>
                </form>
            </div>

@endsection