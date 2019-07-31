<?php

namespace ASD_Aphrodite\Http\Controllers;

use ASD_Aphrodite\Transazione;
use Illuminate\Http\Request;
use DB;

class TransazioneController extends Controller
{
    public function __construct() {

        $this->middleware('accessoAdmin');
    }

    public function index () {
        //acquisizione di tutte le transazioni
        $lista_transazioni = Transazione::all();

        //chiamata della vista dell'indice
        return view('transazioni.index')->with('lista_transazioni', $lista_transazioni);
    }

    public function create() {
        //chiama la vista del form di inserimento
        return view('transazioni.create');
    }

    public function store(Request $request)
    {
        if ($request->in_entrata == 0) {

            //validazione dei campi obbligatori della richiesta
            $request->validate([
                'documento_fiscale' => 'required',
                'importo' => 'required',
                'modalita_pagamento' => 'required',
            ]);
            //controllo della correttezza dell'importo
            if ($request->importo < 0) {

                $request->session()->flash('errore', 'ERRORE! L\'importo non può essere minore di 0');

                return view('transazione.create');
            }
            $transazione = new Transazione();

            //salvataggio delle tessere
            $transazione->numero_documento_fiscale = date('YmdHis');
            $transazione->tipo_documento_fiscale = $request->documento_fiscale;
            $transazione->importo = $request->importo;
            $transazione->data_erogazione = date('Y-m-d');
            $transazione->modalita_pagamento = $request->modalita_pagamento;
            $transazione->in_entrata = 0;

            //controllo del soggetto a cui fare la transazione
            if ($request->partita_iva == NULL) {

                $transazione->causale = "Pagamento del socio";
                $transazione->codice_fiscale_soggetto_transazione = $request->codice_fiscale;
            } else {

                $transazione->causale = "Pagamento del fornitore";
                $transazione->partita_iva_soggetto_transazione_id = $request->partita_iva;
            }
            $transazione->saveOrFail();
            return view('soci.completamento')
                ->with('password_in_chiaro', '0');
        } else {
            //validazione dei campi obbligatori della richiesta
            $request->validate([
                'documento_fiscale' => 'required',
                'importo' => 'required',
                'modalita_pagamento' => 'required',
                'codice_fiscale' => 'required',
                'ruolo_sportivo' => 'required',
                'password' => 'required'
            ]);
            //controllo della correttezza dell'importo
            if ($request->importo < 0) {

                $request->session()->flash('errore', 'ERRORE! L\'importo non può essere minore di 0');

                return view('transazione.create');
            }

            $transazione = new Transazione();

            //salvataggio delle tessere
            $transazione->numero_documento_fiscale = date('YmdHis');
            $transazione->tipo_documento_fiscale = $request->documento_fiscale;
            $transazione->importo = $request->importo;
            $transazione->causale = "Tassa di iscrizione";
            $transazione->data_erogazione = date('Y-m-d');
            $transazione->modalita_pagamento = $request->modalita_pagamento;
            $transazione->in_entrata = 1;
            $transazione->codice_fiscale_soggetto_transazione = $request->codice_fiscale;
            $transazione->saveOrFail();

            return view('soci.completamento')
                ->with('password_in_chiaro', $request->password)
                ->with('inaccessibile', 0);
        }
    }

   
    public function show($numero_documento_fiscale) {

        $transazione = DB::table('transazioni')->where('numero_documento_fiscale', $numero_documento_fiscale)->first();

        //chiamata della lista di stampa delle info relative alla transazione
        return view('transazioni.show')
            ->with('transazione', $transazione);
    }

    public function entrata(Request $request){

        //validazione dei campi obbligatori della richiesta
        $request->validate([
            'documento_fiscale' => 'required',
            'importo' => 'required',
            'modalita_pagamento' => 'required',
            'codice_fiscale' => 'required',
            'ruolo_sportivo' => 'required',
            'password' => 'required'
        ]);

        //controllo della correttezza dell'importo
        if($request->importo < 0) {

            $request->session()->flash('errore','ERRORE! L\'importo non pu� essere minore di 0');

        }

        $transazione = new Transazione();

        //salvataggio delle tessere
        $transazione->numero_documento_fiscale = date('YmdHis');
        $transazione->tipo_documento_fiscale = $request->documento_fiscale;
        $transazione->importo = $request->importo;
        $transazione->causale = "Tassa di iscrizione";
        $transazione->data_erogazione = date('Y-m-d');
        $transazione->modalita_pagamento = $request->modalita_pagamento;
        $transazione->in_entrata = 1;
        $transazione->codice_fiscale_soggetto_transazione = $request->codice_fiscale;
        $transazione->saveOrFail();

        return view('soci.completamento')
            ->with('password', $request->password);
    }

    
}