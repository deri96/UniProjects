@extends('layouts.privata')

@section('content')

    <h1>Form di aggiunta di una nuova persona</h1>

            <!-- mostra di eventuali messaggi -->
            @if (session('errore'))
                <div class="alert alert-danger">{{ session('errore') }}</div>
            @else
                <div class="alert alert-success">{{ session('successo') }}</div>
            @endif

            <form action="{{ route('soci.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Nome:</strong>
                            <input type="text" name="nome" class="form-control" placeholder="Nome">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Cognome:</strong>
                            <input type="text" name="cognome" class="form-control" placeholder="Cognome">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>E-mail:</strong>
                            <input type="email" name="email" class="form-control" placeholder="E-mail">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Codice Fiscale:</strong>
                            <input type="text" name="codice_fiscale" class="form-control" placeholder="XXXXXX00X00X000X" size="16">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12"><strong>Indirizzo:</strong></div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <input type="text" name="via" class="form-control" placeholder="Via xxx">
                                </div>
                                <div class="col-xs-1 col-sm-1 col-md-1">
                                    <input type="text" name="numero_civico" class="form-control" placeholder="N°">
                                </div>
                                <div class="col-xs-5 col-sm-5 col-md-5">
                                    <input type="text" name="citta" class="form-control" placeholder="Città">
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
                            <input type="text" name="luogo_nascita" class="form-control" placeholder="Città di nascita">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Data di nascita:</strong>
                            <input type="date" name="data_nascita" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Numero di telefono:</strong>
                            <input type="number" name="numero_telefono" class="form-control" placeholder="1234567890">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Data inizio certificato medico:</strong>
                            <input type="date" name="data_certificato" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Ruolo societario:<br></strong>
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
                            <select name="ruolo_sportivo">
                                <option value="allievo">Allievo</option>
                                <option value="insegnante">Insegnante o stagista iscritto</option>
                                <option value="nessuno">Nessun ruolo sportivo</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <a class="btn btn-small btn-primary" href="{{ URL::to('soci/') }}">Torna indietro</a>
                        <button type="submit" class="btn btn-primary">Prosegui</button>
                    </div>
                </div>

            </form>
@endsection