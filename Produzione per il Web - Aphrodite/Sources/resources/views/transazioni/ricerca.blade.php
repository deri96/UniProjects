@extends('layouts.privata')

@section('content')

    <h2>Ricerca la transazione in base ad uno dei criteri definiti sotto.<br><br>
    N.B. La ricerca è effettuabile con un solo criterio alla volta.<br><br></h2>

    <form action="{{ URL::to('ricerca_per_ndf') }}" method="get">

            <h2>Cerca per numero documento fiscale</h2><br>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <input type="text" name="numero_documento_fiscale" class="form-control" placeholder="123456789">
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <button type="submit" class="btn btn-primary">Prosegui</button>
                </div>
            </div>
    </form>
    <br><br>
    <form action="{{ URL::to('ricerca_per_tipo') }}" method="get">
            <h2>Cerca per tipo documento fiscale</h2>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <select name="tipo_documento_fiscale">
                        <option value="ricevuta_numerata">Ricevuta numerata</option>
                        <option value="ricevuta">Ricevuta</option>
                        <option value="ricevuta_fiscale">Ricevuta fiscale</option>
                        <option value="fattura">Fattura</option>
                    </select>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <button type="submit" class="btn btn-primary">Prosegui</button>
                </div>
            </div>
    </form>
    <br><br>
    <form action="{{ URL::to('ricerca_per_entrata') }}" method="get">
        <h2>Cerca per tipo di transazione</h2><br>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                <div class="form-group">
                    <input type="radio" class="form-check-inline" name="in_entrata" value="1" checked>In entrata
                    <input type="radio" class="form-check-inline" name="in_entrata" value="0">In uscita
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                <button type="submit" class="btn btn-primary">Prosegui</button>
            </div>
        </div>
    </form>
    <br><br>
    <form action="{{ URL::to('ricerca_per_data_partenza') }}" method="get">
        <h2>Cerca per elementi successivi alla data</h2><br>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                <input type="date" name="data_erogazione" class="form-control">
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                <button type="submit" class="btn btn-primary">Prosegui</button>
            </div>
        </div>
    </form>
    <br><br>
    <form action="{{ URL::to('ricerca_per_data_arrivo') }}" method="get">
        <h2>Cerca per elementi precedenti alla data</h2><br>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                <input type="date" name="data_erogazione" class="form-control">
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                <button type="submit" class="btn btn-primary">Prosegui</button>
            </div>
        </div>
    </form>
    <br><br>

    <br><br>
    <a class="btn btn-small btn-primary" href="{{ URL::to('transazioni/') }}">Torna indietro</a>

@endsection