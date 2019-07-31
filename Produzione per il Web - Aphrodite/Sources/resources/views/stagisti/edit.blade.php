@extends('layouts.privata')

@section('content')

    <!-- mostra di eventuali messaggi -->
    @if (session('errore'))
        <div class="alert alert-danger">{{ session('errore') }}</div>
    @else
        <div class="alert alert-success">{{ session('successo') }}</div>
    @endif

            <h1>Form di modifica di {{$stagista->nome ." " .$stagista->cognome}}</h1>

            <form action="{{ route('stagisti.update', $stagista->codice_fiscale) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Codice Fiscale:</strong>
                            <input type="text" name="codice_fiscale" class="form-control" value="{{$stagista->codice_fiscale}}" placeholder="{{$stagista->codice_fiscale}}">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Partita IVA:</strong>
                            <input type="number" name="partita_iva" class="form-control" value="{{$stagista->partita_iva}}" placeholder="{{$stagista->partita_iva}}">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Nome:</strong>
                            <input type="text" name="nome" class="form-control" value="{{$stagista->nome}}" placeholder="{{$stagista->nome}}">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Cognome:</strong>
                            <input type="text" name="cognome" class="form-control" value="{{$stagista->cognome}}" placeholder="{{$stagista->cognome}}">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12"><strong>Indirizzo:</strong></div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <input type="text" name="via" class="form-control" value="{{$indirizzo->via}}" placeholder="{{$indirizzo->via}}">
                                </div>
                                <div class="col-xs-1 col-sm-1 col-md-1">
                                    <input type="text" name="numero_civico" class="form-control" value="{{$indirizzo->numero_civico}}" placeholder="{{$indirizzo->numero_civico}}">
                                </div>
                                <div class="col-xs-5 col-sm-5 col-md-5">
                                    <input type="text" name="citta" class="form-control" value="{{$indirizzo->citta}}" placeholder="{{$indirizzo->citta}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Sesso:<br></strong>
                            <input type="radio" class="form-check-inline" name="sesso" value="1" checked>Uomo
                            <input type="radio" class="form-check-inline" name="sesso" value="0">Donna
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Luogo di nascita:</strong>
                            <input type="text" name="luogo_nascita" class="form-control" value="{{$stagista->luogo_nascita}}" placeholder="{{$stagista->luogo_nascita}}">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Data di nascita:</strong><br>
                            <strong>Attuale: {{date('d-m-Y', strtotime($stagista->data_nascita))}}</strong>
                            <input type="date" name="data_nascita" value="{{$stagista->data_nascita}}" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <a class="btn btn-small btn-primary" href="{{ URL::to('stagisti/') }}">Torna indietro</a>
                        <button type="submit" class="btn btn-primary">Prosegui</button>
                    </div>
                </div>

            </form>

@endsection