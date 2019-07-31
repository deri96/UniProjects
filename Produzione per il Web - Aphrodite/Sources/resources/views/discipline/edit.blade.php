@extends('layouts.privata')

@section('content')

    <!-- mostra di eventuali messaggi -->
    @if (session('errore'))
        <div class="alert alert-danger">{{ session('errore') }}</div>
    @else
        <div class="alert alert-success">{{ session('successo') }}</div>
    @endif

    <h1>Form di modifica della disciplina {{$disciplina->nome}}</h1>



            <form action="{{ route('discipline.update', $disciplina->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Nome:</strong><br>
                            <input type="text" name="nome" value="{{$disciplina->nome}}" class="form-control" placeholder="{{$disciplina->nome}}">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <a class="btn btn-small btn-primary" href="{{ URL::to('discipline/') }}">Torna indietro</a>
                        <button type="submit" class="btn btn-primary">Prosegui</button>
                    </div>
                </div>

            </form>
@endsection