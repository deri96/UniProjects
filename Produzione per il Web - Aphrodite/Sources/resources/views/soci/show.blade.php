@extends('layouts.privata')

@section('content')

    <h1><center>Stampa delle informazioni su {{ $tessera->nome ." " .$tessera->cognome }}</center></h1>


    <div class="jumbotron text-center">
        <form action="{{route('soci.destroy', $tessera->id)}}" method="POST">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                <a class="btn btn-small btn-primary" href="{{ URL::to('soci/') }}">Torna alla lista</a>

                <strong><br><br>OPERAZIONI EFFETTUABILI</strong><br>
                @if ($tessera->ruolo_sportivo == 'allievo')
                    @if ($corso_acquistato != NULL)
                        @if ($corso_acquistato->data_fine_corso < date('Y-m-d'))
                            <a class="btn btn-small btn-block" style="color: #1b1e21" href="{{ route('rinnovo_pacchetto', $tessera->id) }}"><b> - Rinnova il pacchetto acquistato</b></a>
                        @endif
                        <a class="btn btn-small btn-block" style="color: #1b1e21" href="{{ route('corsi_acquistati.edit', $tessera->id) }}"><b> - Cambia il pacchetto acquistato</b></a>
                    @else
                        <a class="btn btn-small btn-block" style="color: #1b1e21" href="{{ route('corsi_acquistati.edit', $tessera->id) }}"><b> - Acquista un nuovo pacchetto</b></a>
                    @endif

                @endif

                @if ($tessera->ruolo_societario != 'ordinario' && $tessera->ruolo_sportivo != 'allievo')
                    <a class="btn btn-small btn-block" style="color: #1b1e21" href="{{ route('transazione_socio', $tessera->id) }}"><b> - Aggiungi una transazione al socio</b></a>
                @endif

                <a class="btn btn-small btn-block" style="color: #1b1e21" href="{{ URL::to('soci/' . $tessera->id . '/edit') }}"><b> - Modifica il socio</b></a>

                <a class="btn btn-small btn-block" style="color: #1b1e21" href="{{ route('aggiornamento_tessera', $tessera->id) }}"><b> - Aggiornamento tessera</b></a>

                <a class="btn btn-small btn-block" style="color: #1b1e21" href="{{ route('aggiornamento_assicurazione', $tessera->id) }}"><b> - Aggiornamento assicurazione</b></a>

                <a class="btn btn-small btn-block" style="color: #1b1e21" href="{{ route('aggiornamento_certificato', $tessera->id) }}"><b> - Aggiornamento certificato medico</b></a>
                <br>
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-small btn-danger">Elimina il socio</button>
            </div>
            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">

                    <h2>{{ $tessera->nome ." " .$tessera->cognome }}</h2>
                    <p>
                        <strong>Codice fiscale:</strong> {{ $socio->codice_fiscale }}<br>
                        <strong>Indirizzo:</strong> {{ $indirizzo->via ." N° " .$indirizzo->numero_civico .", " .$indirizzo->citta}}<br>
                        <strong>E-mail:</strong> {{ $utente->email }}<br>
                        @if ($tessera->sesso == 1)
                            <strong>Sesso:</strong> Uomo <br>
                        @else
                            <strong>Sesso:</strong> Donna <br>
                        @endif
                        <strong>Luogo di nascita:</strong> {{ $tessera->luogo_nascita }}<br>
                        <strong>Data di nascita:</strong> {{ date('d-m-Y', strtotime($tessera->data_nascita)) }}<br>
                        <strong>Data di iscrizione:</strong> {{ date('d-m-Y', strtotime($tessera->data_iscrizione)) }}<br>
                        <strong>Numero di telefono:</strong> {{ $tessera->numero_telefono }}<br>
                        <strong>Data scadenza tessera:</strong> {{ date('d-m-Y', strtotime($tessera->scadenza)) }}<br>
                        <strong>Numero di assicurazione:</strong> {{ $tessera->numero_assicurazione }}<br>
                        <strong>Data validità assicurazione:</strong> {{ "Dal " .date('d-m-Y', strtotime($tessera->data_inizio_assicurazione)) ." al " .date('d-m-Y', strtotime($tessera->data_fine_assicurazione)) }}<br>
                        <strong>Data validità certificato medico:</strong> {{ "Dal " .date('d-m-Y', strtotime($tessera->data_inizio_certificato_medico)) ." al " .date('d-m-Y', strtotime($tessera->data_fine_certificato_medico)) }}<br>
                        @if ($tessera->ruolo_societario != 'ordinario')
                            <strong>Ruolo societario:</strong> {{ $tessera->ruolo_societario }}<br>
                        @endif
                        @if ($tessera->ruolo_societario != 'nessuno')
                            <strong>Ruolo sportivo:</strong> {{ $tessera->ruolo_sportivo }}<br>
                        @endif
                        @if ($tessera->note != NULL)
                            <strong>Note aggiuntive:</strong> {{ $tessera->note }}<br>
                        @endif
                        @if ($tessera->ruolo_sportivo == 'allievo')
                            @if ($corso_acquistato != NULL)
                                <strong>Pacchetto acquistato:</strong> {{ $corso_acquistato->nome }}<br>
                                @if($corso_acquistato->data_fine_corso < date('Y-m-d'))
                                    Attenzione! il corso è scaduto il giorno {{$corso_acquistato->data_fine_corso}}
                                @else
                                    Il corso scade il giorno {{$corso_acquistato->data_fine_corso}}
                                @endif
                            @else
                                <strong>Pacchetto acquistato:</strong> Nessun pacchetto acquistato<br>
                            @endif
                        @endif
                    </p>

            </div>
        </div>
        </form>

        </div>
    </div>

@endsection