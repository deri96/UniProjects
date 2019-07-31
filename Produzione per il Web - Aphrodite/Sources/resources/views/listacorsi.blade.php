@extends('layouts.pubblica')

@section('content')
    <div class="container1">

        <center><strong style="font-size: 3vw; color: #4AA02C;"><b>I nostri corsi</b></strong></center><br>

            <!-- Eventuale messaggio di errore -->
            @if (Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
            @endif



        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top: 5%">
                <table class="table table-striped table-bordered" style="font-size: 1.5vw; text-align: center;">
                    <thead>
                    <tr style="background-color: #7FE817;">
                        <th>NOME CORSO</th>
                        <th>DISCIPLINA</th>
                        <th>COSTO ORARIO</th>
                        <th>INSEGNANTE</th>
                        <th>STAGISTA</th>
                    </tr>
                    </thead>
                    <tbody style="background-color: #7FE857;">
                    @foreach($lista_corsi as $corso)
                        <tr>
                            <td><b>{{ $corso->nome }}</b></td>
                            <td><b>{{ $corso->nome_disciplina }}</b></td>
                            <td><b>{{ number_format($corso->costo, 2) }}</b></td>
                            <td>
                                @if($corso->insegnante_id != NULL)
                                    @foreach ($lista_insegnanti as $insegnante)
                                        @if($insegnante->codice_fiscale == $corso->insegnante_id)
                                            <b>{{$insegnante->nome ." " .$insegnante->cognome}}</b>
                                        @endif
                                    @endforeach
                                @else
                                     -
                                @endif
                            </td>
                            <td>
                                @if($corso->stagista_id != NULL)
                                    @foreach ($lista_stagisti as $stagista)
                                        @if($stagista->codice_fiscale == $corso->stagista_id)
                                            <b>{{$stagista->nome ." " .$stagista->cognome}}</b>
                                        @endif
                                    @endforeach
                                @else
                                    -
                                @endif
                            </td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    </body>
</html>
@endsection