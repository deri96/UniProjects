@extends('layouts.privata')

@section('content')

            <h1>Stampa delle informazioni sul calendario dei tuoi corsi</h1>

            <div class="jumbotron text-center">
                @if ($pacchetto != NULL)
                    <h2><strong>Nome pacchetto acquistato:</strong> {{$pacchetto->nome}}<br></h2>
                    <strong><br>Nome corso:</strong> {{$corso_I->nome}}<br>
                    <strong>Orari del corso per i prossimi 7 giorni</strong><br>
                    @foreach($orari_corso_I as $orario)
                        <br><i>Giorno {{date('d-m', strtotime($orario->giorno_ora))}} alle ore {{date('H', strtotime($orario->giorno_ora))}} in sala {{$orario->nome}}<br>
                        @if($orario->note != NULL)
                                <strong>Note:</strong> {{$orario->note}}<br></i>
                        @endif
                    @endforeach

                    @if($corso_II != NULL)
                        <strong><br>Nome corso:</strong> {{$corso_II->nome}}<br>
                        <strong>Orari del corso per i prossimi 7 giorni</strong><br>
                        @foreach($orari_corso_II as $orario)
                            Giorno {{date('d-m', strtotime($orario->giorno_ora))}} alle ore {{date('H', strtotime($orario->giorno_ora))}} in sala {{$orario->nome}}<br>
                            @if($orario->note != NULL)
                                <strong>Note:</strong> {{$orario->note}}<br>
                            @endif
                        @endforeach
                    @endif

                    @if($corso_III != NULL)
                        <strong><br>Nome corso:</strong> {{$corso_II->nome}}<br>
                        <strong>Orari del corso per i prossimi 7 giorni</strong><br>
                        @foreach($orari_corso_III as $orario)
                            Giorno {{date('d-m', strtotime($orario->giorno_ora))}} alle ore {{date('H', strtotime($orario->giorno_ora))}} in sala {{$orario->nome}}<br>
                            @if($orario->note != NULL)
                                <strong>Note:</strong> {{$orario->note}}<br>
                            @endif
                        @endforeach
                    @endif
                @else
                    <strong>Nome pacchetto acquistato:</strong><br>
                    Non hai ancora acquistato un pacchetto. <br>Vai in segreteria e richiedine uno!
                @endif
            </div>



@endsection