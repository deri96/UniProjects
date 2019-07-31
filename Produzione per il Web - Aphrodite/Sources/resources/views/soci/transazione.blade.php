@extends('layouts.privata')

@section('content')

            <h1>Form di aggiunta della transazione per {{$tessera->nome ." " .$tessera->cognome}}</h1>

            <!-- mostra di eventuali messaggi -->
            @if (session('errore'))
                <div class="alert alert-danger">{{ session('errore') }}</div>
            @endif

            <form action="{{ route('transazioni.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Tipo di documento fiscale da rilasciare:<br></strong>
                            <select name="documento_fiscale">
                                <option value="ricevuta_numerata">Ricevuta numerata</option>
                                <option value="ricevuta">Ricevuta</option>
                                <option value="ricevuta_fiscale">Ricevuta fiscale</option>
                                <option value="fattura">Fattura</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Importo totale (in euro):</strong>
                            <input type="number" name="importo" step="0.01" class="form-control" placeholder="0,00">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Modalità di pagamento:<br></strong>
                            <select name="modalita_pagamento">
                                <option value="contanti">Contanti</option>
                                <option value="assegno">Assegno</option>
                                <option value="bonifico">Bonifico bancario</option>
                                <option value="bancomat">Bancomat</option>
                                <option value="carta_credito">Carta di credito</option>
                                <option value="paypal">PayPal</option>
                            </select>
                        </div>
                    </div>
                    <input hidden name="in_entrata" value="0">
                    <input hidden name="codice_fiscale" value="{{$socio->codice_fiscale}}">
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">Prosegui</button>
                    </div>

                </div>
            </form>
@endsection