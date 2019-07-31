@extends('layouts.corsi')

@section('content_corsi')

    <!-- Eventuale messaggio di errore -->
    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif


    <h1><center>Lista delle discipline</center></h1>
    <a class="btn btn-primary" style="background-color: #1f6fb2" href="{{ URL::to('discipline/create') }}">Aggiungi una disciplina</a>


                <table class="table table-striped table-bordered">
                    <thead style="background-color: #3f9ae5; color: white">
                    <tr>
                        <td>NOME DISCIPLINA</td>
                    </tr>
                    </thead>
                    <tbody  style="background-color: #3bb9ff;">
                    @foreach($lista_discipline as $valore)
                        <tr>
                            <td><b>{{ $valore->nome }}</b></td>

                            <!-- Bottone per mostrare lo stagista-->
                            <td>
                                <a class="btn btn-small btn-success" style="background-color: #1f6fb2" href="{{ URL::to('discipline/' . $valore->id .'/edit') }}">Modifica la disciplina</a>
                            </td>
                            <td>
                                <form action="{{route('discipline.destroy', $valore->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-small btn-danger">Elimina la disciplina</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
@endsection