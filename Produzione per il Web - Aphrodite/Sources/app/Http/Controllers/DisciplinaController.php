<?php

namespace ASD_Aphrodite\Http\Controllers;

use ASD_Aphrodite\Corso;
use ASD_Aphrodite\Corso_Acquistato;
use ASD_Aphrodite\Disciplina;
use ASD_Aphrodite\Pacchetto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DisciplinaController extends Controller
{
    public function __construct() {

        $this->middleware('accessoAdmin');
    }

    public function index () {

        //acquisizione di tutte le discipline
        $lista_discipline = DB::table('discipline')
            ->orderBy('nome')->get();

        //chiamata della vista dell'indice
        return view('discipline.index')->with('lista_discipline', $lista_discipline);
    }

    public function create() {

        return view('discipline.create');
    }

    public function store(Request $request) {

        //validazione dei campi obbligatori della richiesta
        $request->validate([
            'nome' => 'required',
        ]);

        //controllo del nome inserito
        if(DB::table('discipline')->where('nome', $request->nome)->count() > 0) {

            $request->session()->flash('errore','ERRORE! La disciplina inserita è gia presente');

            return view('discipline.create');
        }

        $disciplina = new Disciplina();

        $disciplina->nome = $request->nome;
        $disciplina->saveOrFail();

        return view('discipline.completamento')->with('disciplina', $disciplina);
    }

    public function show($id) {

    }

    public function edit($id) {

        $disciplina = Disciplina::find($id);


        return view('discipline.edit')
            ->with('disciplina', $disciplina);
    }

    public function update(Request $request, $id){

        //validazione dei campi obbligatori della richiesta
        $request->validate([
            'nome' => 'required',
        ]);

        //controllo del nome inserito
        if(DB::table('discipline')->where('nome', $request->nome)->count() > 0) {

            $request->session()->flash('errore','ERRORE! La disciplina inserita è gia presente');

            return view('discipline.create');
        }

        $disciplina = Disciplina::find($id);

        $disciplina->nome = $request->nome;
        $disciplina->saveOrFail();

        return view('discipline.completamento')->with('disciplina', $disciplina);
    }

    public function destroy($id) {

        $disciplina = Disciplina::find($id);

        $lista_corsi = DB::table('corsi')
            ->where('disciplina_id', $id)
            ->get();

        foreach ($lista_corsi as $cor) {

            $lista_pacchetti = DB::table('pacchetti_corsi')
                ->where('corso_I', $cor->id)
                ->orWhere('corso_II', $cor->id)
                ->orWhere('corso_III', $cor->id)
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

            Corso::destroy($cor->id);
        }

        $disciplina->delete();

        //acquisizione di tutte le discipline
        $lista_discipline = DB::table('discipline')
            ->orderBy('nome')->get();

        //chiamata della vista dell'indice
        return view('discipline.index')->with('lista_discipline', $lista_discipline);
    }

}
