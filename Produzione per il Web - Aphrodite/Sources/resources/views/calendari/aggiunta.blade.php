@extends('layouts.privata')

@section('content')

            <!-- mostra di eventuali messaggi -->
            @if (session('errore'))
                <div class="alert alert-danger">{{ session('errore') }}</div>
            @else
                <div class="alert alert-success">{{ session('successo') }}</div>
            @endif

            <h1>Form di aggiunta di un nuovo settaggio<br> in data {{date('d-m H:i', strtotime($giorno_ora))}}</h1>


            <form action="{{ route('calendari.store') }}" method="POST">
                @csrf

                <input hidden name="giorno_ora" value="{{$giorno_ora}}">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Sala:<br></strong>
                            <select name="sala">
                                @foreach($lista_sale as $sala)
                                    <option value="{{$sala->id}}">{{$sala->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Corso:<br></strong>
                            <select name="corso">
                                @foreach($lista_corsi as $corso)
                                    <option value="{{$corso->id}}">{{$corso->nome}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Note:<br></strong>
                            <textarea class="form-control" style="height:150px" name="note" placeholder="Note integrative"></textarea>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <a class="btn btn-small btn-primary" href="{{ URL::to('calendari/') }}">Torna indietro</a>
                        <button type="submit" class="btn btn-primary">Prosegui</button>
                    </div>
                </div>

            </form>

@endsection