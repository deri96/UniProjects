@extends('layouts.privata')

@section('content')

            <h1>Stampa delle informazioni su {{ $pacchetto->nome}}</h1>

            <div class="jumbotron text-center">
                <form action="{{route('pacchetti.destroy', $pacchetto->id)}}" method="POST">
                    <div class="row">
                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                            <a class="btn btn-small btn-primary" href="{{ URL::to('pacchetti/') }}">Torna alla lista</a>

                            <strong><br><br>OPERAZIONI EFFETTUABILI</strong><br>
                            <a class="btn btn-small btn-block" style="color: #1b1e21" href="{{ URL::to('pacchetti/' . $pacchetto->id . '/edit') }}"> - Modifica il pacchetto</a>
                            <br>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-small btn-danger">Elimina il pacchetto</button>
                        </div>
                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                            <h2>{{ $pacchetto->nome}}</h2>
                            <p>
                                <strong>Prezzo totale:</strong> {{ number_format($pacchetto->prezzo, 2) }} € <br>
                                <strong>Primo corso:</strong> {{ $primo_corso->nome }}<br>
                                @if($pacchetto->corso_II != NULL)
                                    <strong>Secondo corso:</strong> {{ $secondo_corso->nome }}<br>
                                @endif
                                @if($pacchetto->corso_III != NULL)
                                    <strong>Terzo corso:</strong> {{ $terzo_corso->nome }}<br>
                                @endif
                            </p>
                        </div>
                    </div>
                </form>
            </div>
@endsection