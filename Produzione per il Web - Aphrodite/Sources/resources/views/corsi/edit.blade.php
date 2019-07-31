@extends('layouts.privata')

@section('content')



            <!-- mostra di eventuali messaggi -->
            @if (session('errore'))
                <div class="alert alert-danger">{{ session('errore') }}</div>
            @else
                <div class="alert alert-success">{{ session('successo') }}</div>
            @endif

            <h1>Form di modifica del corso {{$corso->nome}}</h1>

            <form action="{{ route('corsi.update', $corso->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Nome:</strong><br>
                            <input type="text" name="nome" value="{{$corso->nome}}" class="form-control" placeholder="{{$corso->nome}}">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Disciplina:<br></strong>
                            <strong>Attuale: {{$nome_disciplina}}</strong><br>
                            <select name="disciplina">
                                @foreach($lista_discipline as $valore)
                                    <option value="{{$valore->id}}">{{$valore->nome}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Costo orario (in euro):</strong>
                            <input type="number" name="costo" step="0.01" value="{{$corso->costo}}" class="form-control" placeholder="{{$corso->costo}}">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Insegnante:<br></strong>
                            @if($nome_insegnante != NULL)
                                <strong>Attuale: {{$nome_insegnante}}</strong><br>
                            @endif
                            <select name="insegnante">
                                <option value="-1">Nessun insegnante</option>
                                @foreach($lista_insegnanti as $valore)
                                    <option value="{{$valore->codice_fiscale}}">{{$valore->nome ." " .$valore->cognome}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Stagista:<br></strong>
                            @if($nome_stagista != NULL)
                                <strong>Attuale: {{$nome_stagista}}</strong><br>
                            @endif
                            <select name="stagista">
                                <option value="-1">Nessuno stagista</option>
                                @foreach($lista_stagisti as $valore)
                                    <option value="{{$valore->codice_fiscale}}">{{$valore->nome ." " .$valore->cognome}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <a class="btn btn-small btn-primary" href="{{ URL::to('corsi/') }}">Torna indietro</a>
                        <button type="submit" class="btn btn-primary">Prosegui</button>
                    </div>
                </div>

            </form>

@endsection