@extends('layouts.privata')

@section('content')
    <!-- mostra di eventuali messaggi -->
    @if (session('errore'))
        <div class="alert alert-danger">{{ session('errore') }}</div>
    @else
        <div class="alert alert-success">{{ session('successo') }}</div>
    @endif

    <h1>Form di aggiunta di un nuovo fornitore</h1>



            <form action="{{ route('fornitori.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Partita IVA:</strong>
                            <input type="number" name="partita_iva" class="form-control" placeholder="1234567890">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Nome fornitore:</strong>
                            <input type="text" name="nome" class="form-control" placeholder="Fornitore">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Ragione sociale:<br></strong>
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
                            <input type="email" name="email" class="form-control" placeholder="E-mail">
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
                            <strong>Tipo fornitura:<br></strong>
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
                            <input type="number" name="numero_telefono" class="form-control" placeholder="1234567890">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Note:</strong>
                            <textarea class="form-control" style="height:150px" name="note" placeholder="Note integrative"></textarea>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <a class="btn btn-small btn-primary" href="{{ URL::to('fornitori/') }}">Torna indietro</a>
                        <button type="submit" class="btn btn-primary">Prosegui</button>
                    </div>
                </div>

            </form>

@endsection