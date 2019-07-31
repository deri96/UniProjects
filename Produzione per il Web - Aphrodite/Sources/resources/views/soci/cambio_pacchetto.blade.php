@extends('layouts.privata')

@section('content')

    <form action="{{ URL::to('soci/modifica_pacchetto/' .$tessera->id) }}" method="POST">
                @csrf

                <input hidden name="tessera_id" value="{{$tessera->id}}">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Nuovo pacchetto da acquistare:<br></strong>
                            <strong>Attuale: {{$corso_acquistato->nome}}<br></strong>
                            <select name="pacchetto_acquistato">
                                @foreach($lista_pacchetti as $pacchetto)
                                    <option value="{{$pacchetto->id}}">{{$pacchetto->nome}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <a class="btn btn-small btn-primary" href="{{ URL::to('soci/') }}">Torna indietro</a>
                    <button type="submit" class="btn btn-primary">Prosegui</button>
                </div>

        </form>

@endsection