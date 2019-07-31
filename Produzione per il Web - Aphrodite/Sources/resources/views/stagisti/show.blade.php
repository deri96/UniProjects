@extends('layouts.privata')

@section('content')

            <h1>Stampa delle informazioni su {{ $stagista->nome ." " .$stagista->cognome}}</h1>

            <div class="jumbotron text-center">
                <form action="{{route('stagisti.destroy', $stagista->codice_fiscale)}}" method="POST">
                    <div class="row">
                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                            <a class="btn btn-small btn-primary" href="{{ URL::to('stagisti/') }}">Torna alla lista</a>

                            <strong><br><br>OPERAZIONI EFFETTUABILI</strong><br>

                            <a class="btn btn-small btn-block" style="color: #1b1e21" href="{{ route('transazione_stagista', $stagista->codice_fiscale) }}"><b> - Aggiungi una transazione allo stagista</b></a>

                            <a class="btn btn-small btn-block" style="color: #1b1e21" href="{{ URL::to('stagisti/' . $stagista->codice_fiscale . '/edit') }}"><b> - Modifica lo stagista</b></a>
                            <br>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-small btn-danger">Elimina lo stagista</button>


                        </div>
                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                            <h2>{{ $stagista->nome ." " .$stagista->cognome}}</h2>
                            <p>
                                <strong>Codice Fiscale:</strong> {{ $stagista->codice_fiscale }}<br>
                                <strong>Partita IVA:</strong> {{ $stagista->partita_iva }}<br>
                                <strong>Nome:</strong> {{ $stagista->nome }}<br>
                                <strong>Cognome:</strong> {{ $stagista->cognome }}<br>
                                <strong>Indirizzo:</strong> {{ $indirizzo->via ." N° " .$indirizzo->numero_civico .", " .$indirizzo->citta}}<br>
                                <strong>Luogo di nascita:</strong> {{ $stagista->luogo_nascita }}<br>
                                <strong>Data di nascita:</strong> {{ date('d-m-Y', strtotime($stagista->data_nascita)) }}<br>
                            </p>
                        </div>
                    </div>
                </form>
            </div>
 @endsection