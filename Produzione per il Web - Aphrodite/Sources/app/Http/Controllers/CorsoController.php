<?php

namespace ASD_Aphrodite\Http\Controllers;

use ASD_Aphrodite\Corso;
use ASD_Aphrodite\Corso_Acquistato;
use ASD_Aphrodite\Disciplina;
use ASD_Aphrodite\Pacchetto;
use ASD_Aphrodite\Stagista;
use ASD_Aphrodite\Tessera;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CorsoController extends Controller
{
    public function __construct() {

        $this->middleware('accessoAdmin')->except('i_miei_corsi');
        $this->middleware('accessoUtente')->only('i_miei_corsi');
    }

    public function index () {

        //acquisizione di tutti i corsi
        $lista_corsi = DB::table('corsi')
            ->orderBy('disciplina_id')
            ->orderBy('nome')
            ->orderBy('costo')->get();

        //chiamata della vista dell'indice
        return view('corsi.index')->with('lista_corsi', $lista_corsi);
    }

    public function create() {

        $lista_discipline = Disciplina::all();

        $lista_stagisti = Stagista::all();

        $lista_insegnanti = DB::table('tessere')
            ->where('ruolo_sportivo', 'insegnante')
            ->join('soci', 'tessere.id', '=', 'soci.tessera_id')->get();

        return view('corsi.create')
            ->with('lista_discipline', $lista_discipline)
            ->with('lista_stagisti', $lista_stagisti)
            ->with('lista_insegnanti', $lista_insegnanti);
    }

    public function store(Request $request) {

        //validazione dei campi obbligatori della richiesta
        $request->validate([
            'nome' => 'required',
            'disciplina' => 'required',
            'costo' => 'required',
        ]);

        $errore = false;

        //controllo del costo orario
        if($request->costo < 0) {

            $request->session()->flash('errore','ERRORE! Il costo orario non può essere negativo');

            $errore = true;
        }

        //controllo sugli insegnanti
        if($request->insegnante == -1 && $request->stagista == -1) {

            $request->session()->flash('errore','ERRORE! Deve essere presente almeno uno tra insegnante e stagista');

            $errore = true;
        }

        //controllo sugli insegnanti
        if($request->insegnante != -1 && $request->stagista != -1) {

            $request->session()->flash('errore','ERRORE! Non possono essere presenti contemporaneamente insegnanti e stagisti');

            $errore = true;
        }

        //procedura di errore
        if($errore == true) {

            $lista_discipline = Disciplina::all();

            $lista_stagisti = Stagista::all();

            $lista_insegnanti = DB::table('tessere')
                ->where('ruolo_sportivo', 'insegnante')
                ->join('soci', 'tessere.id', '=', 'soci.tessera_id')->get();

            return view('corsi.create')
                ->with('lista_discipline', $lista_discipline)
                ->with('lista_stagisti', $lista_stagisti)
                ->with('lista_insegnanti', $lista_insegnanti);
        }

        $corso = new Corso();

        $corso->nome = $request->nome;
        $corso->disciplina_id = $request->disciplina;
        $corso->costo = $request->costo;
        if($request->insegnante != -1)
            $corso->insegnante_id = $request->insegnante;
        if($request->stagista != -1)
            $corso->stagista_id = $request->stagista;

        $corso->saveOrFail();

        $pacchetto = new Pacchetto();

        $pacchetto->nome = "Pacchetto solo " .$corso->nome;
        $pacchetto->prezzo = $corso->costo * 12;        //3 giorni alla settimana * 4 settimane
        $pacchetto->corso_I = $corso->id;

        $pacchetto->saveOrFail();

        return view('corsi.completamento')->with('corso', $corso);
    }

    public function show($id) {

        $insegante = NULL;
        $stagista = NULL;
        $lista_pacchetti = NULL;

        //cerca il socio
        $corso = Corso::find($id);

        if($corso->insegnante_id != NULL)
            $insegante = DB::table('tessere')
                ->where('ruolo_sportivo', 'insegnante')
                ->where('soci.codice_fiscale', $corso->insegnante_id)
                ->join('soci', 'tessere.id', '=', 'soci.tessera_id')
                ->first();

        if($corso->stagista_id != NULL)
            $stagista = DB::table('stagisti')
                ->where('codice_fiscale', $corso->stagista_id)
                ->first();

        $disciplina = DB::table('discipline')->where('id', $corso->disciplina_id)->first();

        if (DB::table('pacchetti_corsi')
                ->where('corso_I', '=', $corso->id)
                ->orWhere('corso_II', '=', $corso->id)
                ->orWhere('corso_III', '=', $corso->id)->count() != 0) {

            $lista_pacchetti = DB::table('pacchetti_corsi')
                ->where('corso_I', '=', $corso->id)
                ->orWhere('corso_II', '=', $corso->id)
                ->orWhere('corso_III', '=', $corso->id)
                ->orderBy('nome')
                ->get();
        }


        //chiamata della lista di stampa delle info
        return view('corsi.show')
            ->with('corso', $corso)
            ->with('disciplina', $disciplina)
            ->with('insegnante', $insegante)
            ->with('stagista',$stagista)
            ->with('lista_pacchetti_associati', $lista_pacchetti);
    }

    public function edit($id) {

        $nome_insegnante = NULL;
        $nome_stagista = NULL;

        $corso = Corso::find($id);

        $lista_discipline = Disciplina::all();

        $lista_stagisti = Stagista::all();

        $lista_insegnanti = DB::table('tessere')
            ->where('ruolo_sportivo', 'insegnante')
            ->join('soci', 'tessere.id', '=', 'soci.tessera_id')->get();

        $disciplina = Disciplina::find($corso->disciplina_id);
        $nome_disciplina = $disciplina->nome;

        if($corso->insegnante_id != NULL) {

            $insegnante = DB::table('soci')
                ->where('codice_fiscale', $corso->insegnante_id)
                ->join('tessere', 'tessere.id','=','soci.tessera_id')
                ->first();
            $nome_insegnante = $insegnante->nome ." " .$insegnante->cognome;
        }

        if($corso->stagista_id != NULL) {

            $stagista = DB::table('stagisti')
                ->where('codice_fiscale', $corso->stagista_id)
                ->first();

            $nome_stagista = $stagista->nome ." " .$stagista->cognome;
        }


        return view('corsi.edit')
            ->with('lista_discipline', $lista_discipline)
            ->with('lista_stagisti', $lista_stagisti)
            ->with('lista_insegnanti', $lista_insegnanti)
            ->with('nome_disciplina', $nome_disciplina)
            ->with('nome_insegnante', $nome_insegnante)
            ->with('nome_stagista', $nome_stagista)
            ->with('corso', $corso);
    }

    public function update(Request $request, $id){

        //validazione dei campi obbligatori della richiesta
        $request->validate([
            'nome' => 'required',
            'disciplina' => 'required',
            'costo' => 'required',
        ]);

        $errore = false;

        //controllo del costo orario
        if($request->costo <= 0) {

            $request->session()->flash('errore','ERRORE! Il costo orario non può essere negativo');

            $errore = true;
        }

        //controllo sugli insegnanti
        if($request->insegnante == -1 && $request->stagista == -1) {

            $request->session()->flash('errore','ERRORE! Deve essere presente almeno uno tra insegnante e stagista');

            $errore = true;
        }

        //controllo sugli insegnanti
        if($request->insegnante != -1 && $request->stagista != -1) {

            $request->session()->flash('errore','ERRORE! Non possono essere presenti contemporaneamente insegnanti e stagisti');

            $errore = true;
        }

        //procedura di errore
        if($errore == true) {

            $lista_discipline = Disciplina::all();

            $lista_stagisti = Stagista::all();

            $lista_insegnanti = DB::table('tessere')
                ->where('ruolo_sportivo', 'insegnante')
                ->join('soci', 'tessere.id', '=', 'soci.tessera_id')->get();

            return view('corsi.create')
                ->with('lista_discipline', $lista_discipline)
                ->with('lista_stagisti', $lista_stagisti)
                ->with('lista_insegnanti', $lista_insegnanti);
        }

        $corso = Corso::find($id);

        $corso->nome = $request->nome;
        $corso->disciplina_id = $request->disciplina;
        $corso->costo = $request->costo;
        if($request->insegnante != -1)
            $corso->insegnante_id = $request->insegnante;
        else
            $corso->insegnante_id = NULL;
        if($request->stagista != -1)
            $corso->stagista_id = $request->stagista;
        else
            $corso->stagista_id = NULL;
        $corso->saveOrFail();


        $pacchetto_trovato = DB::table('pacchetti_corsi')
            ->where('corso_I', $corso->id)
            ->whereNull('corso_II')
            ->whereNull('corso_III')
            ->first();

        $pacchetto = Pacchetto::findOrFail($pacchetto_trovato->id);
        $pacchetto->nome = "Pacchetto solo " .$corso->nome;
        $pacchetto->prezzo = $corso->costo * 12;        //3 giorni alla settimana * 4 settimane

        $pacchetto->saveOrFail();

        return view('corsi.completamento')->with('corso', $corso);
    }

    public function destroy($id) {

        $corso = Corso::find($id);

        $lista_pacchetti = DB::table('pacchetti_corsi')
            ->where('corso_I', $corso->id)
            ->whereNull('corso_II')
            ->whereNull('corso_III')
            ->get();


        foreach ($lista_pacchetti as $pacch) {

            $lista_corsi_acquistati = DB::table('corsi_acquistati')
                ->where('pacchetto_acquistato', $pacch->id)
                ->get();

            foreach ($lista_corsi_acquistati as $corso_acq) {

                $corso_acquistato = Corso_Acquistato::find($corso_acq->id);

                $corso_acquistato->pacchetto_acquistato = NULL;
                $corso_acquistato->save();
            }

            $pacchetto = Pacchetto::find($pacch->id);

            $pacchetto->delete();
        }

        $lista_pacchetti_contenenti = DB::table('pacchetti_corsi')
            ->where('corso_I', $corso->id)
            ->orWhere('corso_II', $corso->id)
            ->orWhere('corso_III', $corso->id)
            ->get();

        foreach ($lista_pacchetti_contenenti as $pacch) {

            $lista_corsi_acquistati = DB::table('corsi_acquistati')
                ->where('pacchetto_acquistato', $pacch->id)
                ->get();

            foreach ($lista_corsi_acquistati as $corso_acq) {

                $corso_acquistato = Corso_Acquistato::find($corso_acq->id);

                $corso_acquistato->pacchetto_acquistato = NULL;
                $corso_acquistato->save();
            }

            $pacchetto = Pacchetto::find($pacch->id);

            $pacchetto->delete();
        }

        $corso->delete();

        //acquisizione di tutti i corsi
        $lista_corsi = DB::table('corsi')
            ->orderBy('disciplina_id')
            ->orderBy('nome')
            ->orderBy('costo')->get();

        //chiamata della vista dell'indice
        return view('corsi.index')->with('lista_corsi', $lista_corsi);
    }

    public function i_miei_corsi ($tessera_id) {

        $pacchetto_acquistato = NULL;

        $disciplina_I = NULL;
        $disciplina_II = NULL;
        $disciplina_III = NULL;

        $corso_I = NULL;
        $corso_II = NULL;
        $corso_III = NULL;

        $insegnanti = NULL;
        $stagisti = NULL;

        $tessera = Tessera::find($tessera_id);

        $corso_acquistato = Corso_Acquistato::find($tessera->corso_acquistato);

        if($corso_acquistato->pacchetto_acquistato != NULL) {

            $pacchetto_acquistato = Pacchetto::find($corso_acquistato->pacchetto_acquistato);

            if ($pacchetto_acquistato->corso_I != NULL) {

                $corso_I = DB::table('corsi')
                    ->where('id', $pacchetto_acquistato->corso_I)
                    ->first();

                $disciplina_I = Disciplina::find($corso_I->disciplina_id);
            }

            if ($pacchetto_acquistato->corso_II != NULL) {

                $corso_II = DB::table('corsi')
                    ->where('id', $pacchetto_acquistato->corso_II)
                    ->first();

                $disciplina_II = Disciplina::find($corso_II->disciplina_id);
            }


            if ($pacchetto_acquistato->corso_III != NULL) {

                $corso_III = DB::table('corsi')
                    ->where('id', $pacchetto_acquistato->corso_III)
                    ->first();

                $disciplina_III = Disciplina::find($corso_III->disciplina_id);
            }

            $insegnanti = DB::table('tessere')
                ->where('ruolo_sportivo', 'insegnante')
                ->join('soci', 'soci.tessera_id', '=', 'tessere.id')
                ->get();

            $stagisti = Stagista::all();
        }

        return view('corsi.i_miei_corsi')
            ->with('disciplina_I', $disciplina_I)
            ->with('disciplina_II', $disciplina_II)
            ->with('disciplina_III', $disciplina_III)
            ->with('pacchetto', $pacchetto_acquistato)
            ->with('corso_acquistato', $corso_acquistato)
            ->with('corso_I', $corso_I)
            ->with('corso_II', $corso_II)
            ->with('corso_III', $corso_III)
            ->with('lista_insegnanti', $insegnanti)
            ->with('lista_stagisti', $stagisti);
    }
}
