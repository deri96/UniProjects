@extends('layouts.privata')

@section('content')


    <h1>Stampa delle informazioni sui corsi acquistati </h1>

            <div class="jumbotron text-center">
                @if($pacchetto != NULL)
                    <h1><center>{{$pacchetto->nome}}</center></h1><br>
                    Il pacchetto acquistato ha le seguenti informazioni:<br>
                    <strong>Tariffa mensile del pacchetto:</strong> {{ number_format($pacchetto->prezzo, 2) }} €<br>
                    <strong>Scadenza:</strong> {{date('d-m-Y', strtotime($corso_acquistato->data_fine_corso))}}<br><br>
                    <br>I corsi che la compongono sono:<br><br>

                    <h2>{{ $corso_I->nome }}</h2>
                    Disciplina: {{$disciplina_I->nome}}<br>
                    @if($corso_I->insegnante_id != NULL)
                        Insegnante:
                        @foreach ($lista_insegnanti as $insegnante)
                            @if($insegnante->codice_fiscale == $corso_I->insegnante_id)
                                {{$insegnante->nome ." " .$insegnante->cognome}}<br>
                            @endif
                        @endforeach
                    @endif
                    @if($corso_I->stagista_id != NULL)
                        Stagista:
                        @foreach ($lista_stagisti as $stagista)
                            @if($stagista->codice_fiscale == $corso_I->stagista_id)
                                {{$stagista->nome ." " .$stagista->cognome}}<br>
                            @endif
                        @endforeach
                    @endif
                    Costo orario: {{number_format($corso_I->costo, 2)}} €<br>

                    @if($corso_II != NULL)
                        <br><h2>{{ $corso_II->nome }}</h2>
                        Disciplina: {{$disciplina_II->nome}}<br>
                        @if($corso_II->insegnante_id != NULL)
                            Insegnante:
                            @foreach ($lista_insegnanti as $insegnante)
                                @if($insegnante->codice_fiscale == $corso_II->insegnante_id)
                                    {{$insegnante->nome ." " .$insegnante->cognome}}<br>
                                @endif
                            @endforeach
                        @endif
                        @if($corso_II->stagista_id != NULL)
                            Stagista:
                            @foreach ($lista_stagisti as $stagista)
                                @if($stagista->codice_fiscale == $corso_II->stagista_id)
                                    {{$stagista->nome ." " .$stagista->cognome}}<br>
                                @endif
                            @endforeach
                        @endif
                        Costo orario: {{number_format($corso_II->costo, 2)}} €<br>
                    @endif

                    @if($corso_III != NULL)
                        <br><h2>{{ $corso_III->nome }}</h2>
                        Disciplina: {{$disciplina_III->nome}}<br>
                        @if($corso_III->insegnante_id != NULL)
                            Insegnante:
                            @foreach ($lista_insegnanti as $insegnante)
                                @if($insegnante->codice_fiscale == $corso_III->insegnante_id)
                                    {{$insegnante->nome ." " .$insegnante->cognome}}<br>
                                @endif
                            @endforeach
                        @endif
                        @if($corso_III->stagista_id != NULL)
                            Stagista:
                            @foreach ($lista_stagisti as $stagista)
                                @if($stagista->codice_fiscale == $corso_III->stagista_id)
                                    {{$stagista->nome ." " .$stagista->cognome}}<br>
                                @endif
                            @endforeach
                        @endif
                        Costo orario: {{number_format($corso_III->costo, 2)}} €<br>
                    @endif
                @else
                    Non hai ancora acquistato un pacchetto. <br>Vai in segreteria e richiedine uno!
                @endif

            </div>



@endsection