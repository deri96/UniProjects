<?php

namespace ASD_Aphrodite\Http\Controllers;

use ASD_Aphrodite\Corso;
use ASD_Aphrodite\Stagista;
use ASD_Aphrodite\Indirizzo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StagistaController extends Controller
{
    public function __construct() {

        $this->middleware('accessoAdmin');
    }

    public function index () {

        //acquisizione di tutti gli stagisti
        $lista_stagisti = DB::table('stagisti')
            ->orderBy('cognome')
            ->orderBy('nome')
            ->orderBy('data_nascita')->get();

        //chiamata della vista dell'indice
        return view('stagisti.index')->with('lista_stagisti', $lista_stagisti);
    }

    public function create() {

        //chiama la vista del form di inserimento
        return view('stagisti.create');
    }

    public function store(Request $request) {

        //validazione dei campi obbligatori della richiesta
        $request->validate([
            'nome' => 'required',
            'cognome' => 'required',
            'codice_fiscale' => 'required',
            'via' => 'required',
            'numero_civico' => 'required',
            'citta' => 'required',
            'sesso' => 'required',
            'luogo_nascita' => 'required',
            'data_nascita' => 'required',
        ]);

        //controllo dell'esistenza dello stagista
        if(DB::table('stagisti')->where('codice_fiscale', $request->codice_fiscale)->first() != NULL) {

            $request->session()->flash('errore','ERRORE! Lo stagista esiste già');

            return view('stagisti.create');
        }

        if($request->data_nascita > date('Y-m-d')) {

            $request->session()->flash('errore','ERRORE! La data è errata');

            return view('stagisti.create');
        }

        $indirizzo = new Indirizzo();

        //controllo dell'esistenza dell'indirizzo in modo da usare quello gia esistente
        if(($indirizzo_da_cercare = DB::table('indirizzi')->where('via', $request->via)
                ->where('numero_civico', $request->numero_civico)
                ->where('citta', $request->citta)->first()) != NULL) {

            $indirizzo = $indirizzo_da_cercare;
        } else {

            //salvataggio dell'indirizzo
            $indirizzo->via = $request->via;
            $indirizzo->numero_civico = $request->numero_civico;
            $indirizzo->citta = $request->citta;
            $indirizzo->saveOrFail();
        }

        $stagista = new Stagista();

        //salvataggio dello stagista
        $stagista->indirizzo_id = $indirizzo->id;
        $stagista->codice_fiscale = $request->codice_fiscale;
        $stagista->partita_iva = $request->partita_iva;
        $stagista->nome = $request->nome;
        $stagista->cognome = $request->cognome;
        $stagista->sesso = $request->sesso;
        $stagista->luogo_nascita = $request->luogo_nascita;
        $stagista->data_nascita = $request->data_nascita;
        $stagista->saveOrFail();

        return view('stagisti.completamento')->with('stagista', $stagista);
    }

    public function show($codice_fiscale) {

        //cerca lo stagista
        $stagista = DB::table('stagisti')->where('codice_fiscale', $codice_fiscale)->first();

        $indirizzo = DB::table('indirizzi')->where('id', $stagista->indirizzo_id)->first();


        //chiamata della lista di stampa delle info
        return view('stagisti.show')
            ->with('stagista', $stagista)
            ->with('indirizzo', $indirizzo);
    }

    public function edit($codice_fiscale) {

        $stagista = DB::table('stagisti')->where('codice_fiscale', $codice_fiscale)->first();

        $indirizzo = DB::table('indirizzi')->where('id', $stagista->indirizzo_id)->first();

        return view('stagisti.edit')
            ->with('stagista', $stagista)
            ->with('indirizzo', $indirizzo);
    }

    public function update(Request $request, $codice_fiscale){

        //validazione dei campi obbligatori della richiesta
        $request->validate([
            'nome' => 'required',
            'cognome' => 'required',
            'codice_fiscale' => 'required',
            'via' => 'required',
            'numero_civico' => 'required',
            'citta' => 'required',
            'sesso' => 'required',
            'luogo_nascita' => 'required',
            'data_nascita' => 'required',
        ]);

        if($request->data_nascita > date('Y-m-d')) {

            $request->session()->flash('errore','ERRORE! La data è errata');

            return view('stagisti.create');
        }

        $indirizzo = new Indirizzo();

        //controllo dell'esistenza dell'indirizzo in modo da usare quello gia esistente
        if(($indirizzo_da_cercare = DB::table('indirizzi')->where('via', $request->via)
                ->where('numero_civico', $request->numero_civico)
                ->where('citta', $request->citta)->first()) != NULL) {

            $indirizzo = $indirizzo_da_cercare;
        } else {

            //salvataggio dell'indirizzo
            $indirizzo->via = $request->via;
            $indirizzo->numero_civico = $request->numero_civico;
            $indirizzo->citta = $request->citta;
            $indirizzo->saveOrFail();
        }

        DB::table('stagisti')->where('codice_fiscale', $codice_fiscale)->delete();

        $stagista = new Stagista();

        //salvataggio dello stagista
        $stagista->indirizzo_id = $indirizzo->id;
        $stagista->codice_fiscale = $request->codice_fiscale;
        $stagista->partita_iva = $request->partita_iva;
        $stagista->nome = $request->nome;
        $stagista->cognome = $request->cognome;
        $stagista->sesso = $request->sesso;
        $stagista->luogo_nascita = $request->luogo_nascita;
        $stagista->data_nascita = $request->data_nascita;
        $stagista->saveOrFail();

        $request->session()->flash('successo','Stagista modificato con successo');

        $lista_stagisti = Stagista::all();

        return view('stagisti.index')->with('lista_stagisti', $lista_stagisti);
    }

    public function destroy($codice_fiscale) {

        $lista_corsi = NULL;

        if(DB::table('corsi')->where('stagista_id', $codice_fiscale)->count() > 0)
            $lista_corsi = DB::table('corsi')->where('stagista_id', $codice_fiscale)->get();

        if($lista_corsi != NULL){

            foreach ($lista_corsi as $cor){

                $corso = Corso::find($cor->id);
                $corso->stagista_id = NULL;
                $corso->save();
            }
        }

        DB::table('stagisti')->where('codice_fiscale', $codice_fiscale)->delete();

        $lista_stagisti = Stagista::all();
        return view('stagisti.index')->with('lista_stagisti', $lista_stagisti);

    }

    public function transazione($codice_fiscale) {

        $stagista = DB::table('stagisti')->where('codice_fiscale', $codice_fiscale)->first();

        return view('stagisti.transazione')->with('stagista', $stagista);
    }
}
