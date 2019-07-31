@extends('layouts.privata')

@section('content')

    <form action="{{ route('corsi_acquistati.update', $tessera->corso_acquistato) }}" method="POST">
                @csrf
                @method('PUT')

                <input hidden name="tessera_id" value="{{$tessera->id}}">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Nuovo pacchetto da acquistare:<br></strong>
                            @if($corso_acquistato != NULL)
                                <strong>Attuale: {{$corso_acquistato->nome}}<br></strong>
                            @endif
                            <select name="pacchetto_acquistato">
                                @foreach($lista_pacchetti as $pacchetto)
                                    <option value="{{$pacchetto->id}}">{{$pacchetto->nome}}</option>
                                @endforeach
                            </select>
                            <br><br>
                                    <div class="form-group">
                                        <strong>Tipo di documento fiscale da rilasciare:<br></strong>
                                        <select name="documento_fiscale">
                                            <option value="ricevuta_numerata">Ricevuta numerata</option>
                                            <option value="ricevuta">Ricevuta</option>
                                            <option value="ricevuta_fiscale">Ricevuta fiscale</option>
                                            <option value="fattura">Fattura</option>
                                        </select>
                                    </div>
                                </div><br>
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
                                <input hidden name="in_entrata" value="1">
                                <input hidden name="causale" value="Iscrizione al corso">
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <a class="btn btn-small btn-primary" href="{{ URL::to('soci/') }}">Torna indietro</a>
                    <button type="submit" class="btn btn-primary">Prosegui</button>
                </div>

            </form>
@endsection