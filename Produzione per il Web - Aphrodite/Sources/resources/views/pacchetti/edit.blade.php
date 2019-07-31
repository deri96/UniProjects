@extends('layouts.privata')

@section('content')
    <!-- mostra di eventuali messaggi -->
    @if (session('errore'))
        <div class="alert alert-danger">{{ session('errore') }}</div>
    @else
        <div class="alert alert-success">{{ session('successo') }}</div>
    @endif

            <h1>Form di aggiunta di un nuovo pacchetto</h1>

            <form action="{{ route('pacchetti.update', $pacchetto->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Nome:</strong><br>
                            <input type="text" name="nome" value="{{$pacchetto->nome}}" class="form-control" placeholder="{{$pacchetto->nome}}">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Prezzo totale:</strong><br>
                            <input type="number" name="prezzo" class="form-control" step="0.01" value="{{$pacchetto->prezzo}}" placeholder="{{$pacchetto->prezzo}}">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Primo corso:</strong><br>
                            <strong>Attuale: {{$primo_corso->nome}}</strong><br>
                            <select name="corso_I">
                                @foreach($lista_corsi as $valore)
                                    <option value="{{$valore->id}}">{{$valore->nome}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Secondo corso:<br></strong>
                            @if($pacchetto->corso_II)
                                <strong>Attuale: {{$secondo_corso->nome}}</strong><br>
                            @endif
                            <select name="corso_II">
                                <option value="-1">Nessun corso</option>
                                @foreach($lista_corsi as $valore)
                                    <option value="{{$valore->id}}">{{$valore->nome}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Terzo corso:<br></strong>
                            @if($pacchetto->corso_III)
                                <strong>Attuale: {{$terzo_corso->nome}}</strong><br>
                            @endif
                            <select name="corso_III">
                                <option value="-1">Nessun corso</option>
                                @foreach($lista_corsi as $valore)
                                    <option value="{{$valore->id}}">{{$valore->nome}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <a class="btn btn-small btn-primary" href="{{ URL::to('pacchetti/') }}">Torna indietro</a>
                        <button type="submit" class="btn btn-primary">Prosegui</button>
                    </div>
                </div>

            </form>
@endsection