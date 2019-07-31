<?php

namespace ASD_Aphrodite\Http\Controllers;

use ASD_Aphrodite\Corso_Acquistato;
use ASD_Aphrodite\Pacchetto;
use ASD_Aphrodite\Socio;
use ASD_Aphrodite\Tessera;
use ASD_Aphrodite\Transazione;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CorsoAcquistatoController extends Controller
{
    public function __construct() {

        $this->middleware('accessoAdmin');
    }

    public function edit($id) {

        $tessera = Tessera::find($id);


        $corso_acquistato = NULL;

        if($corso_acquistato = DB::table('corsi_acquistati')
            ->where('corsi_acquistati.id', $tessera->corso_acquistato)->count() > 0) {

            $corso_acquistato = DB::table('corsi_acquistati')
                ->where('corsi_acquistati.id', $tessera->corso_acquistato)
                ->join('pacchetti_corsi', 'pacchetti_corsi.id', '=', 'corsi_acquistati.pacchetto_acquistato')
                ->first();
        }

        if($corso_acquistato != NULL) {

            $lista_pacchetti = DB::table('pacchetti_corsi')
                ->where('id', '!=', $corso_acquistato->pacchetto_acquistato)
                ->get();
        } else {

            $lista_pacchetti = Pacchetto::all();
        }

        return view('corsi_acquistati.edit')
            ->with('tessera', $tessera)
            ->with('lista_pacchetti', $lista_pacchetti)
            ->with('corso_acquistato', $corso_acquistato);
    }

    public function update(Request $request, $id){

        $request->validate([
            'pacchetto_acquistato' => 'required',
            'tessera_id' => 'required',
        ]);

        $corso_acquistato = Corso_Acquistato::find($id);

        $corso_acquistato->pacchetto_acquistato = $request->pacchetto_acquistato;
        $corso_acquistato->data_inizio_corso = date('Y-m-d');
        $corso_acquistato->data_fine_corso = date('Y-m-d', strtotime('+1 months'));
        $corso_acquistato->saveOrFail();

        $pacchetto = Pacchetto::find($corso_acquistato->pacchetto_acquistato);

        $socio = DB::table('soci')
            ->where('tessera_id', $request->tessera_id)
            ->first();

        $transazione = new Transazione();

        //salvataggio delle transazioni
        $transazione->numero_documento_fiscale = date('YmdHis');
        $transazione->tipo_documento_fiscale = $request->documento_fiscale;
        $transazione->importo = $pacchetto->prezzo;
        $transazione->causale = $request->causale;
        $transazione->data_erogazione = date('Y-m-d');
        $transazione->modalita_pagamento = $request->modalita_pagamento;
        $transazione->in_entrata = $request->in_entrata;
        $transazione->codice_fiscale_soggetto_transazione = $socio->codice_fiscale;
        $transazione->saveOrFail();

        $request->session()->flash('successo','Corso del socio modificato con successo');

        $lista_soci = Tessera::all();

        return view('soci.completamento')
            ->with('lista_soci', $lista_soci)
            ->with('password_in_chiaro', 0)
            ->with('prezzo', $pacchetto->prezzo);

    }


}
