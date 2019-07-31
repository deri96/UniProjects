@extends('layouts.privata')

@section('content')

    <!-- mostra di eventuali messaggi -->
    @if (session('errore'))
        <div class="alert alert-danger">{{ session('errore') }}</div>
    @else
        <div class="alert alert-success">{{ session('successo') }}</div>
    @endif

            <h1>Form di modifica di {{$fornitore->nome ." " .$fornitore->ragione_sociale}}</h1>



            <form action="{{ route('fornitori.update', $fornitore->partita_iva) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Partita IVA:</strong>
                            <input type="number" name="partita_iva" class="form-control" value="{{$fornitore->partita_iva}}" placeholder="{{$fornitore->partita_iva}}">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Nome fornitore:</strong>
                            <input type="text" name="nome" class="form-control" value="{{$fornitore->nome}}" placeholder="{{$fornitore->nome}}">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Ragione sociale:<br></strong>
                            <strong>Attuale: {{$fornitore->ragione_sociale}}</strong><br>
                            <select name="ragione_sociale">
                                <option value="privato">Privato</option>
                                <option value="SRL">SRL</option>
                                <option value="SNC">SNC</option>
                                <option value="SPA">SPA</option>
                                <option value="SAS">SAS</option>
                                <option value="SS">SS</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>E-mail:</strong>
                            <input type="email" name="email" class="form-control" value="{{$fornitore->email}}" placeholder="{{$fornitore->email}}">
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
                            <strong>Tipo fornitura:<br></strong>
                            <strong>Attuale: {{$fornitore->tipo_fornitura}}</strong><br>
                            <select name="tipo_fornitura">
                                <option value="generico">Generico</option>
                                <option value="affitto">Affitto</option>
                                <option value="energia">Energia</option>
                                <option value="gas">Gas</option>
                                <option value="acqua">Acqua</option>
                                <option value="consumi">Consumi</option>
                                <option value="abbigliamento">Abbigliamento</option>
                                <option value="pubblicità">Pubblicità</option>
                                <option value="cancelleria">Cancelleria</option>
                                <option value="assistenza">Assistenza</option>
                                <option value="commercialista">Commercialista</option>
                                <option value="assicurazione">Assicurazione</option>
                                <option value="pulizie">Pulizie</option>
                                <option value="altro">Altro (specifica in note)</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Numero di telefono:</strong>
                            <input type="number" name="numero_telefono" class="form-control" value="{{$fornitore->numero_telefono}}" placeholder="{{$fornitore->numero_telefono}}">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Note:</strong>
                            <textarea class="form-control" style="height:150px" name="note" value="{{$fornitore->note}}" placeholder="{{$fornitore->note}}"></textarea>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <a class="btn btn-small btn-primary" href="{{ URL::to('fornitori/') }}">Torna indietro</a>
                        <button type="submit" class="btn btn-primary">Prosegui</button>
                    </div>
                </div>

            </form>

@endsection