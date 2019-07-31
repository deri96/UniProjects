<?php

namespace ASD_Aphrodite\Http\Controllers;

use ASD_Aphrodite\Corso;
use ASD_Aphrodite\Pacchetto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PacchettoController extends Controller
{
    public function __construct() {

        $this->middleware('accessoAdmin');
    }

    public function index () {

        //acquisizione di tutti i pacchetti
        $lista_pacchetti = DB::table('pacchetti_corsi')
            ->orderBy('nome')
            ->orderBy('prezzo')->get();

        //chiamata della vista dell'indice
        return view('pacchetti.index')->with('lista_pacchetti', $lista_pacchetti);
    }

    public function create() {

        $lista_corsi = Corso::all();

        return view('pacchetti.create')
            ->with('lista_corsi', $lista_corsi);
    }

    public function store(Request $request) {

        //validazione dei campi obbligatori della richiesta
        $request->validate([
            'nome' => 'required',
            'prezzo' => 'required',
            'corso_I' => 'required',
        ]);

        //controllo del costo orario
        if($request->prezzo < 0) {

            $request->session()->flash('errore','ERRORE! Il prezzo del pacchetto non può essere negativo');

            $lista_corsi = Corso::all();

            return view('pacchetti.create')
                ->with('lista_corsi', $lista_corsi);
        }

        //controllo sugli insegnanti
        if($request->corso_I == $request->corso_II ||
            $request->corso_I == $request->corso_III ||
            $request->corso_II == $request->corso_III) {

            $request->session()->flash('errore','ERRORE! Non può essere definito più volte lo stesso corso');

            $lista_corsi = Corso::all();

            return view('pacchetti.create')
                ->with('lista_corsi', $lista_corsi);
        }

        //gestione dei corsi
        if($request->corso_II == -1 && $request->corso_III != -1) {

            $request->corso_II = $request->corso_III;
            $request->corso_III = NULL;
        }

        $pacchetto = new Pacchetto();

        $pacchetto->nome = $request->nome;
        $pacchetto->prezzo = $request->prezzo;
        $pacchetto->corso_I = $request->corso_I;
        if($request->corso_II != -1)
            $pacchetto->corso_II = $request->corso_II;
        if($request->corso_III != -1)
            $pacchetto->corso_III= $request->corso_III;

        $pacchetto->saveOrFail();

        return view('pacchetti.completamento')->with('pacchetto', $pacchetto);
    }

    public function show($id) {

        //cerca il pacchetto
        $pacchetto = Pacchetto::find($id);

        $primo_corso = NULL;
        $secondo_corso = NULL;
        $terzo_corso = NULL;

        $primo_corso = Corso::find($pacchetto->corso_I);

        if($pacchetto->corso_II != NULL)
            $secondo_corso = Corso::find($pacchetto->corso_II);

        if($pacchetto->corso_III != NULL)
            $terzo_corso = Corso::find($pacchetto->corso_III);

        //chiamata della lista di stampa delle info
        return view('pacchetti.show')
            ->with('pacchetto', $pacchetto)
            ->with('primo_corso', $primo_corso)
            ->with('secondo_corso', $secondo_corso)
            ->with('terzo_corso',$terzo_corso);
    }

    public function edit($id) {

        //cerca il pacchetto
        $pacchetto = Pacchetto::find($id);

        $primo_corso = NULL;
        $secondo_corso = NULL;
        $terzo_corso = NULL;

        $lista_corsi = Corso::all();

        $primo_corso = Corso::find($pacchetto->corso_I);

        if($pacchetto->corso_II != NULL)
            $secondo_corso = Corso::find($pacchetto->corso_II);

        if($pacchetto->corso_III != NULL)
            $terzo_corso = Corso::find($pacchetto->corso_III);

        //chiamata della lista di stampa delle info
        return view('pacchetti.edit')
            ->with('pacchetto', $pacchetto)
            ->with('primo_corso', $primo_corso)
            ->with('secondo_corso', $secondo_corso)
            ->with('terzo_corso',$terzo_corso)
            ->with('lista_corsi', $lista_corsi);
    }

    public function update(Request $request, $id){

        //validazione dei campi obbligatori della richiesta
        $request->validate([
            'nome' => 'required',
            'prezzo' => 'required',
            'corso_I' => 'required',
        ]);

        //controllo del costo orario
        if($request->prezzo < 0) {

            $request->session()->flash('errore','ERRORE! Il prezzo del pacchetto non può essere negativo');

            $lista_corsi = Corso::all();

            return view('pacchetti.edit')
                ->with('lista_corsi', $lista_corsi);
        }

        //controllo sugli insegnanti
        if($request->corso_I == $request->corso_II ||
            $request->corso_I == $request->corso_III ||
            $request->corso_II == $request->corso_III) {

            $request->session()->flash('errore','ERRORE! Non può essere definito più volte lo stesso corso');

            $lista_corsi = Corso::all();

            return view('pacchetti.edit')
                ->with('lista_corsi', $lista_corsi);
        }

        //gestione dei corsi
        if($request->corso_II == -1 && $request->corso_III != -1) {

            $request->corso_II = $request->corso_III;
            $request->corso_III = NULL;
        }

        $pacchetto = Pacchetto::find($id);

        $pacchetto->nome = $request->nome;
        $pacchetto->prezzo = $request->prezzo;
        $pacchetto->corso_I = $request->corso_I;
        if($request->corso_II != -1)
            $pacchetto->corso_II = $request->corso_II;
        if($request->corso_III != -1)
            $pacchetto->corso_III= $request->corso_III;

        $pacchetto->saveOrFail();

        return view('pacchetti.completamento')->with('pacchetto', $pacchetto);
    }

    public function destroy($id) {

        $pacchetto = Pacchetto::find($id);

        $lista_corsi_acquistati = DB::table('corsi_acquistati')
            ->where('pacchetto_acquistato', $pacchetto->id)
            ->get();

        foreach ($lista_corsi_acquistati as $corso_acq) {

            $corso_acquistato = Corso_Acquistato::find($corso_acq->id);

            $corso_acquistato->pacchetto_acquistato = NULL;
            $corso_acquistato->save();
        }


        $pacchetto->delete();

        $lista_pacchetti = DB::table('pacchetti_corsi')
            ->orderBy('nome')
            ->orderBy('prezzo')->get();

        //chiamata della vista dell'indice
        return view('pacchetti.index')->with('lista_pacchetti', $lista_pacchetti);
    }
}
