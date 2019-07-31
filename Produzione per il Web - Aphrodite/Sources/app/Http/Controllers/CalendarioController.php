<?php

namespace ASD_Aphrodite\Http\Controllers;

use ASD_Aphrodite\Calendario;
use ASD_Aphrodite\Corso;
use ASD_Aphrodite\Corso_Acquistato;
use ASD_Aphrodite\Pacchetto;
use ASD_Aphrodite\Sala;
use ASD_Aphrodite\Tessera;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CalendarioController extends Controller
{

    public function __construct() {

        $this->middleware('accessoAdmin')->except('il_mio_calendario');
        $this->middleware('accessoUtente')->only('il_mio_calendario');
    }

    public function index() {

        $lista_calendari = Calendario::all();

        return view('calendari.index')->with('lista_calendari', $lista_calendari);
    }

    public function store(Request $request) {

        //validazione dei campi obbligatori della richiesta
        $request->validate([
            'giorno_ora' => 'required',
            'corso' => 'required',
            'sala' => 'required',
        ]);

        $evento = new Calendario();

        $evento->giorno_ora = $request->giorno_ora;
        $evento->corso_id = $request->corso;
        $evento->sala_id = $request->sala;
        if($request->note != NULL)
            $evento->note = $request->note;

        $evento->saveOrFail();

        $request->session()->flash('successo','SUCCESSO! E\' stato settato un nuovo evento');

        return view('calendari.index');
    }

    public function show($data_ora) {

        $giorno_ora = str_replace('_',' ', $data_ora);

        $lista_info = NULL;

        if($numero_calendari = DB::table('calendari')
            ->where('giorno_ora', date('Y-m-d H:i:s', strtotime($giorno_ora)))
            ->count() > 0){

            $lista_info = DB::table('calendari')
                ->where('giorno_ora', date('Y-m-d H:i:s', strtotime($giorno_ora)))
                ->get();
        }

        $lista_corsi = Corso::all();

        $numero_sale = DB::table('sale')->count();
        $lista_sale = Sala::all();

        if($lista_info != NULL) {

            if(count($lista_sale) > count($lista_info))
                $inseribile = 1;
            else
                $inseribile = 0;
        } else
            $inseribile = 1;


        return view('calendari.show')
            ->with('lista_info', $lista_info)
            ->with('lista_corsi', $lista_corsi)
            ->with('lista_sale', $lista_sale)
            ->with('giorno_ora', $giorno_ora)
            ->with('inseribile', $inseribile);
    }

    public function edit ($id) {

        $evento = Calendario::find($id);

        $sala_attuale = Sala::find($evento->sala_id);

        $corso_attuale = Corso::find($evento->corso_id);

        $lista_eventi = DB::table('calendari')
            ->where('giorno_ora', $evento->giorno_ora)
            ->get();

        $lista_sale_presenti = array();
        foreach ($lista_eventi as $evento)
            array_push($lista_sale_presenti , $evento->sala_id);

        $lista_corsi_presenti = array();
        foreach ($lista_eventi as $evento)
            array_push($lista_corsi_presenti , $evento->corso_id);


        $lista_sale = DB::table('sale')
            ->whereNotIn('id', $lista_sale_presenti)
            ->get();

        $lista_corsi = DB::table('corsi')
            ->whereNotIn('id', $lista_corsi_presenti)
            ->get();

        return view('calendari.edit')
            ->with('evento', $evento)
            ->with('lista_sale', $lista_sale)
            ->with('lista_corsi', $lista_corsi)
            ->with('corso_attuale', $corso_attuale)
            ->with('sala_attuale', $sala_attuale);
    }

    public function update(Request $request, $id) {

        //validazione dei campi obbligatori della richiesta
        $request->validate([
            'giorno_ora' => 'required',
            'corso' => 'required',
            'sala' => 'required',
        ]);

        $evento = Calendario::find($id);


        $evento->corso_id = $request->corso;
        $evento->sala_id = $request->sala;
        $evento->note = $request->note;

        $evento->saveOrFail();


        $request->session()->flash('successo','SUCCESSO! E\' stato modificato un evento');

        return view('calendari.index')
            ->with('evento', $evento);
    }

    public function destroy($id) {

        Calendario::destroy($id);

        return view('calendari.index');
    }

    public function aggiunta ($giorno_ora) {

        $lista_eventi = DB::table('calendari')
            ->where('giorno_ora', $giorno_ora)
            ->get();

        $lista_sale_presenti = array();
        foreach ($lista_eventi as $evento)
            array_push($lista_sale_presenti , $evento->sala_id);

        $lista_corsi_presenti = array();
        foreach ($lista_eventi as $evento)
            array_push($lista_corsi_presenti , $evento->corso_id);


        $lista_sale = DB::table('sale')
            ->whereNotIn('id', $lista_sale_presenti)
            ->get();

        $lista_corsi = DB::table('corsi')
            ->whereNotIn('id', $lista_corsi_presenti)
            ->get();

        return view('calendari.aggiunta')
            ->with('giorno_ora', $giorno_ora)
            ->with('lista_sale', $lista_sale)
            ->with('lista_corsi', $lista_corsi);
    }

    public function il_mio_calendario ($tessera_id) {

        $pacchetto_acquistato = NULL;

        $data_attuale = date('Y-m-d');

        $corso_I = NULL;
        $corso_II = NULL;
        $corso_III = NULL;

        $orari_corso_I = NULL;
        $orari_corso_II = NULL;
        $orari_corso_III = NULL;

        $tessera = Tessera::find($tessera_id);

        $corso_acquistato = Corso_Acquistato::find($tessera->corso_acquistato);

        if($corso_acquistato->pacchetto_acquistato != NULL) {

            $pacchetto_acquistato = Pacchetto::find($corso_acquistato->pacchetto_acquistato);

            if ($pacchetto_acquistato->corso_I != NULL) {

                $corso_I = DB::table('corsi')
                    ->where('id', $pacchetto_acquistato->corso_I)
                    ->first();
                $orari_corso_I = DB::table('calendari')
                    ->where('corso_id', $corso_I->id)
                    ->where('giorno_ora', '>=', $data_attuale)
                    ->join('sale', 'sale.id', '=', 'calendari.sala_id')
                    ->orderBy('giorno_ora')
                    ->get();
            }

            if ($pacchetto_acquistato->corso_II != NULL) {

                $corso_II = DB::table('corsi')
                    ->where('id', $pacchetto_acquistato->corso_II)
                    ->first();
                $orari_corso_II = DB::table('calendari')
                    ->where('corso_id', $corso_II->id)
                    ->where('giorno_ora', '>', $data_attuale)
                    ->join('sale', 'sale.id', '=', 'calendari.sala_id')
                    ->orderBy('giorno_ora')
                    ->get();
            }


            if ($pacchetto_acquistato->corso_III != NULL) {

                $corso_III = DB::table('corsi')
                    ->where('id', $pacchetto_acquistato->corso_III)
                    ->first();
                $orari_corso_III = DB::table('calendari')
                    ->where('corso_id', $corso_III->id)
                    ->where('giorno_ora', '>', $data_attuale)
                    ->join('sale', 'sale.id', '=', 'calendari.sala_id')
                    ->orderBy('giorno_ora')
                    ->get();
            }
        }

        return view('calendari.calendario_corsi')
            ->with('pacchetto', $pacchetto_acquistato)
            ->with('corso_I', $corso_I)
            ->with('orari_corso_I', $orari_corso_I)
            ->with('corso_II', $corso_II)
            ->with('orari_corso_II', $orari_corso_II)
            ->with('corso_III', $corso_III)
            ->with('orari_corso_III', $orari_corso_III);
    }
}
