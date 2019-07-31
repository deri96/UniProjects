@extends('layouts.privata')

@section('content')

            <h1>Stampa delle informazioni sul corso {{ $corso->nome }}</h1>

            <div class="jumbotron text-center">
                <form action="{{route('corsi.destroy', $corso->id)}}" method="POST">
                    <div class="row">
                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                            <a class="btn btn-small btn-primary" href="{{ URL::to('corsi/') }}">Torna alla lista</a>

                            <strong><br><br>OPERAZIONI EFFETTUABILI</strong><br>

                            <a class="btn btn-small btn-block" style="color: #1b1e21"  href="{{ URL::to('corsi/' . $corso->id . '/edit') }}"> - Modifica il corso</a>

                            <br>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-small btn-danger">Elimina il corso</button>
                        </div>
                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                            <h2>{{ $corso->nome }}</h2>
                            <p>
                                <strong>Disciplina:</strong> {{ $disciplina->nome }}<br>
                                <strong>Costo orario:</strong> {{ number_format($corso->costo, 2) }} €<br>
                                @if($insegnante != NULL)
                                    <strong>Insegnante:</strong> {{ $insegnante->nome ." " .$insegnante->cognome }}<br>
                                @endif
                                @if($stagista != NULL)
                                    <strong>Stagista:</strong> {{ $stagista->nome ." " .$stagista->cognome  }}<br>
                                @endif
                                <strong>Lista pacchetti contenenti questo corso:</strong><br>
                                @if($lista_pacchetti_associati != NULL)
                                    @foreach($lista_pacchetti_associati as $pacchetto)
                                        - {{ $pacchetto->nome  }}<br>
                                    @endforeach
                                @else
                                    Nessun corso<br>
                                @endif
                            </p>
                        </div>
                    </div>
                </form>
            </div>
@endsection