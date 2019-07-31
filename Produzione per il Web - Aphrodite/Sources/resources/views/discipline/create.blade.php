@extends('layouts.privata')

@section('content')

            <!-- mostra di eventuali messaggi -->
            @if (session('errore'))
                <div class="alert alert-danger">{{ session('errore') }}</div>
            @else
                <div class="alert alert-success">{{ session('successo') }}</div>
            @endif

            <h1>Form di aggiunta di una nuovo disciplina</h1>


            <form action="{{ route('discipline.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Nome:</strong>
                            <input type="text" name="nome" class="form-control" placeholder="Nome">
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <a class="btn btn-small btn-primary" href="{{ URL::to('discipline/') }}">Torna indietro</a>
                        <button type="submit" class="btn btn-primary">Prosegui</button>
                    </div>
                </div>

            </form>

@endsection