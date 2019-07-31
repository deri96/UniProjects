<?php

use \Illuminate\Support\Facades\DB;
use \Illuminate\Support\Facades\Input;
/*php
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Auth;

Auth::routes();


Route::get('home', function () {

    Auth::logout();
    return view('home');
});

Route::get('/', function () {

    Auth::logout();
    return view('home');
});

Route::get('chisiamo', function () {

    Auth::logout();
    return view('chisiamo');
});

Route::get('listacorsi', function() {

    Auth::logout();
    $lista_corsi = DB::table('corsi')
        ->join('discipline', 'discipline.id','=', 'corsi.disciplina_id')
        ->select('corsi.nome', 'corsi.insegnante_id', 'corsi.stagista_id', 'corsi.costo', 'discipline.nome as nome_disciplina')
        ->get();

    $lista_insegnanti = DB::table('tessere')
        ->where('ruolo_sportivo', 'insegnante')
        ->join('soci', 'soci.tessera_id', '=', 'tessere.id')
        ->get();

    $lista_stagisti = \ASD_Aphrodite\Stagista::all();

    return view('listacorsi')
        ->with('lista_corsi', $lista_corsi)
        ->with('lista_insegnanti', $lista_insegnanti)
        ->with('lista_stagisti', $lista_stagisti);
});

Route::get('avvisi', function() {

    Auth::logout();
    $lista_eventi = DB::table('calendari')
        ->where('giorno_ora', '>=', date('Y-m-d'))
        ->join('sale', 'sale.id', '=', 'calendari.sala_id')
        ->join('corsi', 'corsi.id', '=', 'calendari.corso_id')
        ->orderBy('giorno_ora')
        ->get();

    return view('avvisi')
        ->with('lista_eventi', $lista_eventi);
});

Route::get('contatti', function () {

    Auth::logout();
   return view('contatti');
});

Route::get('area_riservata', function () {

    return view('home_area_riservata');
});



//Route protette dall'autenticazione
Route::group (['middleware' => 'auth'], function() {

    //route di mapping delle tabelle
    Route::resource('soci', 'SocioController');
    Route::resource('corsi', 'CorsoController');
    Route::resource('transazioni', 'TransazioneController');
    Route::resource('fornitori', 'FornitoreController');
    Route::resource('stagisti', 'StagistaController');
    Route::resource('corsi', 'CorsoController');
    Route::resource('discipline', 'DisciplinaController');
    Route::resource('pacchetti', 'PacchettoController');
    Route::resource('corsi_acquistati', 'CorsoAcquistatoController');
    Route::resource('calendari', 'CalendarioController');

    //route per l'aggiornamento della data di scadenza della tessera
    Route::get('soci/aggiornamento_tessera/{id}', 'SocioController@aggiornamento_tessera')->name('aggiornamento_tessera');

    //route per l'aggiornamento della data di scadenza dell'assicurazione
    Route::get('soci/aggiornamento_assicurazione/{id}', 'SocioController@aggiornamento_assicurazione')->name('aggiornamento_assicurazione');

    //route per l'aggiornamento della data di scadenza del certificato medico
    Route::get('soci/aggiornamento_certificato/{id}', 'SocioController@aggiornamento_certificato')->name('aggiornamento_certificato');

    //route per la definizione di una nuova transazione al socio
    Route::get('soci/transazione/{id}', 'SocioController@transazione')->name('transazione_socio');

    //route per la definizione di una nuova transazione allo stagista
    Route::get('stagista/transazione/{id}', 'StagistaController@transazione')->name('transazione_stagista');

    //route per la definizione di una nuova transazione al fornitore
    Route::get('fornitori/transazione/{partita_iva}', 'FornitoreController@transazione')->name('transazione_fornitore');

    //route per il rinnovo del pacchetto del socio
    Route::get('rinnovo_pacchetto/{id}', function ($id) {

        $tessera = \ASD_Aphrodite\Tessera::find($id);

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

            $lista_pacchetti = \ASD_Aphrodite\Pacchetto::all();
        }

        return view('soci.rinnovo')
            ->with('tessera', $tessera)
            ->with('lista_pacchetti', $lista_pacchetti)
            ->with('corso_acquistato', $corso_acquistato);

    })->name('rinnovo_pacchetto');

    //route per il cambio del pacchetto del socio
    Route::get('soci/cambia_pacchetto/{id}', 'SocioController@cambio_pacchetto')->name('cambio_pacchetto');

    //route per l'acquisto del pacchetto del socio
    Route::get('soci/acquista_pacchetto/{id}', 'SocioController@acquisto_pacchetto')->name('acquisto_pacchetto');

    //Route per la stampa delle info sui calendari
    Route::get('calendari/calendario_corsi/{tessera_id}', 'CalendarioController@il_mio_calendario')->name('calendario_corsi');

    //Route per la stampa delle info sui calendari
    Route::get('corsi/i_miei_corsi/{tessera_id}', 'CorsoController@i_miei_corsi')->name('lista_corsi');

    //route per l'aggiunta di un nuovo evento nel calendario
    Route::get('calendari/aggiunta/{giorno_ora}', 'CalendarioController@aggiunta')->name('aggiunta_settaggio');


    //route per il download dei documenti
    Route::get('modulo_iscrizione','DocumentiController@modulo_iscrizione')->name('modulo_iscrizione');
    Route::get('ricevuta_pagamento','DocumentiController@ricevuta_pagamento')->name('ricevuta_pagamento');
    Route::get('ricevuta_iscrizione_minorenne','DocumentiController@ricevuta_iscrizione_minorenne')->name('ricevuta_iscrizione_minorenne');
    Route::get('richiesta_iscrizione_consiglio_direttivo','DocumentiController@richiesta_iscrizione_consiglio_direttivo')->name('richiesta_iscrizione_consiglio_direttivo');

    //route per la riccerca della transazione
    Route::get('ricerca', function(){
       return view('transazioni.ricerca');
    });

    //route per le tipologie di ricerca
    Route::get('ricerca_per_ndf', function() {

        $numero_documento_fiscale = Input::get('numero_documento_fiscale');

        $risultato = DB::table('transazioni')
            ->where('numero_documento_fiscale', $numero_documento_fiscale)
            ->get();

        return view('transazioni/risultato')
            ->with('risultato', $risultato);
    });

    Route::get('ricerca_per_tipo', function() {

        $tipo_documento_fiscale = Input::get('tipo_documento_fiscale');

        $risultato = DB::table('transazioni')
            ->where('tipo_documento_fiscale', $tipo_documento_fiscale)
            ->get();

        return view('transazioni/risultato')
            ->with('risultato', $risultato);
    });

    Route::get('ricerca_per_entrata', function() {

        $in_entrata = Input::get('in_entrata');

        $risultato = DB::table('transazioni')
            ->where('in_entrata', $in_entrata)
            ->get();

        return view('transazioni/risultato')
            ->with('risultato', $risultato);
    });

    Route::get('ricerca_per_data_partenza', function() {

        $data_erogazione = Input::get('data_erogazione');

        $risultato = DB::table('transazioni')
            ->where('data_erogazione', '>=', $data_erogazione)
            ->get();

        return view('transazioni/risultato')
            ->with('risultato', $risultato);
    });

    Route::get('ricerca_per_data_arrivo', function() {

        $data_erogazione = Input::get('data_erogazione');

        $risultato = DB::table('transazioni')
            ->where('data_erogazione', '<', $data_erogazione)
            ->get();

        return view('transazioni/risultato')
            ->with('risultato', $risultato);
    });


});