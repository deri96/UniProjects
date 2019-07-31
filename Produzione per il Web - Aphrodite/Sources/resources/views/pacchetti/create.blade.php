@extends('layouts.privata')

@section('content')

            <!-- mostra di eventuali messaggi -->
            @if (session('errore'))
                <div class="alert alert-danger">{{ session('errore') }}</div>
            @else
                <div class="alert alert-success">{{ session('successo') }}</div>
            @endif

            <h1>Form di aggiunta di un nuovo pacchetto</h1>


            <form action="{{ route('pacchetti.store') }}" method="POST">
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
                            <strong>Prezzo totale:</strong>
                            <input type="number" name="prezzo" class="form-control" step="0.01" placeholder="0,01">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Primo corso:</strong><br>
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
