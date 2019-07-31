<?php

namespace ASD_Aphrodite\Http\Controllers;


use Illuminate\Support\Facades\DB;
use ASD_Aphrodite\Indirizzo;
use ASD_Aphrodite\Fornitore;
use Illuminate\Http\Request;

class FornitoreController extends Controller
{
    public function __construct() {

        $this->middleware('accessoAdmin');
    }

    public function index () {

        //acquisizione di tutti i fornitori
        $lista_fornitori = Fornitore::all();

        //chiamata della vista dell'indice
        return view('fornitori.index')->with('lista_fornitori', $lista_fornitori);
    }

    public function create() {

        //chiama la vista del form di inserimento
        return view('fornitori.create');
    }

    public function store(Request $request) {

        //validazione dei campi obbligatori della richiesta
        $request->validate([
            'nome' => 'required',
            'partita_iva' => 'required',
            'ragione_sociale' => 'required',
            'via' => 'required',
            'numero_civico' => 'required',
            'citta' => 'required',
            'email' => 'required',
            'tipo_fornitura' => 'required',
            'numero_telefono' => 'required',
        ]);

        //controllo dell'esistenza del fornitore
        if(DB::table('fornitori')->where('partita_iva', $request->partita_iva)->first() != NULL) {

            $request->session()->flash('errore','ERRORE! Il fornitore esiste già');

            return view('fornitori.create');
        }

        //controllo dell'esistenza della mail
        if(DB::table('fornitori')->where('email', $request->email)->first() != NULL) {

            $request->session()->flash('errore','ERRORE! L\'e-mail inserita esiste già');

            return view('fornitori.create');
        }

        //controllo della correttezza del tipo di fornitura
        if($request->tipo_fornitura == 'altro' && $request->note == NULL) {

            $request->session()->flash('errore','ERRORE! E\' obbligatorio aggiungere una nota se il tipo di fornitura è \'altro\'');

            return view('fornitori.create');
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

        $fornitore = new Fornitore();

        //salvataggio delle tessere
        $fornitore ->indirizzo_id = $indirizzo->id;
        $fornitore->partita_iva = $request->partita_iva;
        $fornitore ->nome = $request->nome;
        $fornitore->ragione_sociale = $request->ragione_sociale;
        $fornitore->email = $request->email;
        $fornitore->tipo_fornitura = $request->tipo_fornitura;
        $fornitore->numero_telefono = $request->numero_telefono;
        $fornitore->note = $request->note;
        $fornitore->saveOrFail();

        return view('fornitori.completamento')->with('fornitore', $fornitore);
    }

    public function show($partita_iva) {

        //cerca il socio
        $fornitore = DB::table('fornitori')->where('partita_iva', $partita_iva)->first();

        $indirizzo = DB::table('indirizzi')->where('id', $fornitore->indirizzo_id)->first();

        //chiamata della lista di stampa delle info
        return view('fornitori.show')
            ->with('fornitore', $fornitore)
            ->with('indirizzo', $indirizzo);
    }

    public function edit($partita_iva) {

        $fornitore = DB::table('fornitori')->where('partita_iva', $partita_iva)->first();

        $indirizzo = DB::table('indirizzi')->where('id', $fornitore->indirizzo_id)->first();

        return view('fornitori.edit')
            ->with('fornitore', $fornitore)
            ->with('indirizzo', $indirizzo);
    }

    public function update(Request $request, $partita_iva){

        //validazione dei campi obbligatori della richiesta
        $request->validate([
            'nome' => 'required',
            'partita_iva' => 'required',
            'ragione_sociale' => 'required',
            'via' => 'required',
            'numero_civico' => 'required',
            'citta' => 'required',
            'email' => 'required',
            'tipo_fornitura' => 'required',
            'numero_telefono' => 'required',
        ]);

        //controllo dell'esistenza della mail
        if(($fornitore = DB::table('fornitori')->where('email', $request->email)->first()) != NULL) {

            if($fornitore->partita_iva != $partita_iva) {

                $request->session()->flash('errore', 'ERRORE! L\'e-mail inserita esiste già');

                return view('fornitori.edit');
            }
        }

        //controllo della correttezza del tipo di fornitura
        if($request->tipo_fornitura == 'altro' && $request->note == NULL) {

            $request->session()->flash('errore','ERRORE! E\' obbligatorio aggiungere una nota se il tipo di fornitura è \'altro\'');

            return view('fornitori.edit');
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

        DB::table('fornitori')->where('partita_iva', $partita_iva)->delete();

        $fornitore = new Fornitore();

        //salvataggio delle tessere
        $fornitore ->indirizzo_id = $indirizzo->id;
        $fornitore->partita_iva = $request->partita_iva;
        $fornitore ->nome = $request->nome;
        $fornitore->ragione_sociale = $request->ragione_sociale;
        $fornitore->email = $request->email;
        $fornitore->tipo_fornitura = $request->tipo_fornitura;
        $fornitore->numero_telefono = $request->numero_telefono;
        $fornitore->note = $request->note;
        $fornitore->saveOrFail();

        $request->session()->flash('successo','Socio modificato con successo');

        $lista_fornitori = Fornitore::all();

        return view('fornitori.index')->with('lista_fornitori', $lista_fornitori);
    }

    public function destroy($partita_iva) {


        DB::table('fornitori')->where('partita_iva', $partita_iva)->delete();

        $lista_fornitori = Fornitore::all();
        return view('fornitori.index')->with('lista_fornitori', $lista_fornitori);

    }

    public function transazione($partita_iva) {

        $fornitore = DB::table('fornitori')->where('partita_iva', $partita_iva)->first();

        return view('fornitori.transazione')->with('fornitore', $fornitore);
    }
}
