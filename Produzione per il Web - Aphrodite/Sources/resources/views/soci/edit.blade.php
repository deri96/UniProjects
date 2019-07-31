@extends('layouts.privata')

@section('content')
    <!-- mostra di eventuali messaggi -->
            @if (session('errore'))
                <div class="alert alert-danger">{{ session('errore') }}</div>
            @else
                <div class="alert alert-success">{{ session('successo') }}</div>
            @endif


            <form action="{{ route('soci.update', $tessera->id) }}" method="POST" >
                @csrf
                @method('PUT')

                <input hidden name="tessera" value="{{$tessera}}">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Nome:</strong>
                            <input type="text" name="nome" class="form-control" value="{{$tessera->nome}}" placeholder="{{$tessera->nome}}">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Cognome:</strong>
                            <input type="text" name="cognome" class="form-control" value="{{$tessera->cognome}}" placeholder="{{$tessera->cognome}}">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>E-mail:</strong>
                            <input type="email" name="email" class="form-control" value="{{$utente->email}}" placeholder="{{$utente->email}}">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group ">
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
                            <input type="text" name="luogo_nascita" class="form-control" value="{{$tessera->luogo_nascita}}" placeholder="{{$tessera->luogo_nascita}}">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Data di nascita:<br></strong>
                            <strong>Attuale: <i>{{$tessera->data_nascita}}</i></strong>
                            <input type="date" name="data_nascita" value="{{$tessera->data_nascita}}" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Numero di telefono:</strong>
                            <input type="number" name="numero_telefono" class="form-control" value="{{$tessera->numero_telefono}}" placeholder="{{$tessera->numero_telefono}}">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">

                            <strong>Ruolo societario:<br></strong>
                            <strong>Attuale: <i>{{$tessera->ruolo_societario}}</i><br></strong>
                            <select name="ruolo_societario">
                                <option value="presidente">Presidente</option>
                                <option value="vicepresidente">Vicepresidente</option>
                                <option value="dirigente">Dirigente</option>
                                <option value="segretario">Segretario</option>
                                <option value="collaboratore">Collaboratore</option>
                                <option value="ordinario">Nessun ruolo societario</option>
                            </select>

                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">

                            <strong>Ruolo sportivo:<br></strong>
                            <strong>Attuale: <i>{{$tessera->ruolo_sportivo}}</i><br></strong>
                            <select name="ruolo_sportivo">
                                <option value="allievo">Allievo</option>
                                <option value="insegnante">Insegnante o stagista iscritto</option>
                                <option value="nessuno">Nessun ruolo sportivo</option>
                            </select>

                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">

                            <strong>Note:</strong>
                            <textarea class="form-control" style="height:150px" name="note" value="{{$tessera->note}}" placeholder="{{$tessera->note}}"></textarea>

                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <a class="btn btn-small btn-primary" href="{{ URL::to('soci/') }}">Torna indietro</a>
                        <button type="submit" class="btn btn-primary">Prosegui</button>
                    </div>
                </div>

            </form>

@endsection