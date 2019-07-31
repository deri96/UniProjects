<?php

namespace ASD_Aphrodite\Http\Controllers;

use ASD_Aphrodite\Collaboratore;
use ASD_Aphrodite\Corso;
use ASD_Aphrodite\Corso_Acquistato;
use ASD_Aphrodite\Pacchetto;
use ASD_Aphrodite\Transazione;
use Illuminate\Support\Facades\DB;

use ASD_Aphrodite\Indirizzo;
use ASD_Aphrodite\Socio;
use ASD_Aphrodite\Tessera;
use ASD_Aphrodite\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class SocioController extends Controller
{
    public function __construct() {

        $this->middleware('accessoAdmin');
    }

    public function index () {

        //acquisizione di tutti i soci
        $lista_soci = DB::table('tessere')
            ->orderBy('cognome')
            ->orderBy('nome')
            ->orderBy('data_nascita')->get();

        //chiamata della vista dell'indice
        return view('soci.index')->with('lista_soci', $lista_soci);
    }

    public function create() {

        //chiama la vista del form di inserimento
        return view('soci.create');
    }

    public function store(Request $request) {

        //validazione dei campi obbligatori della richiesta
        $request->validate([
            'nome' => 'required',
            'cognome' => 'required',
            'via' => 'required',
            'codice_fiscale' => 'required',
            'numero_civico' => 'required',
            'citta' => 'required',
            'sesso' => 'required',
            'luogo_nascita' => 'required',
            'data_nascita' => 'required',
            'numero_telefono' => 'required',
            'data_certificato' => 'required',
            'ruolo_societario' => 'required',
            'ruolo_sportivo' => 'required',
            'email' => 'required'
        ]);

        //controllo dell'esistenza del socio
        if(DB::table('soci')->where('codice_fiscale', $request->codice_fiscale)->first() != NULL) {

            $request->session()->flash('errore','ERRORE! Il socio esiste già');

            return view('soci.create');
        }

        //controllo dell'esistenza della mail
        if(DB::table('users')->where('email', $request->email)->first() != NULL) {

            $request->session()->flash('errore','ERRORE! L\'e-mail inserita esiste già');

            return view('soci.create');
        }

        //controllo della correttezza delle date
        if($request->data_nascita > $request->data_certificato) {

            $request->session()->flash('errore','ERRORE! La data del certificato non può essere antecedente la data di nascita');

            return view('soci.create');
        }

        //controllo della correttezza delle date
        if(($request->data_nascita > date('Y-m-d')) || ($request->data_certificato > date('Y-m-d'))) {

            $request->session()->flash('errore','ERRORE! La data è errata');

            return view('soci.create');
        }

        //controllo della correttezza del ruolo
        if($request->ruolo_societario == 'ordinario' && $request->ruolo_sportivo == 'nessuno') {

            $request->session()->flash('errore','ERRORE! Non è possibile definire un socio senza nessun ruolo');

            return view('soci.create');
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

        if($request->ruolo_sportivo == 'allievo') {

            $corso_acquistato = new Corso_Acquistato();

            $corso_acquistato->pacchetto_acquistato = NULL;
            $corso_acquistato->data_inizio_corso = '1900-01-01';    //valore di dafault
            $corso_acquistato->data_fine_corso = '1900-01-01';      //valore di default
            $corso_acquistato->saveOrFail();
        }


        $tessera = new Tessera();

        //salvataggio delle tessere
        $tessera->indirizzo_id = $indirizzo->id;
        $tessera->nome = $request->nome;
        $tessera->cognome = $request->cognome;
        $tessera->sesso = $request->sesso;
        $tessera->luogo_nascita = $request->luogo_nascita;
        $tessera->data_nascita = $request->data_nascita;
        $tessera->numero_telefono = $request->numero_telefono;
        $tessera->numero_assicurazione = date('YmdHis');
        $tessera->data_iscrizione = date('Y-m-d');
        $tessera->scadenza = date('Y-m-d', strtotime('+1 years'));
        $tessera->data_inizio_assicurazione = date('Y-m-d');
        $tessera->data_fine_assicurazione = date('Y-m-d', strtotime('+1 years'));
        $tessera->data_inizio_certificato_medico = $request->data_certificato;
        $data = strtotime($request->data_certificato);
        $tessera->data_fine_certificato_medico = date('Y-m-d', strtotime('+6 month', $data));
        $tessera->ruolo_societario = $request->ruolo_societario;
        $tessera->ruolo_sportivo = $request->ruolo_sportivo;
        if($request->ruolo_sportivo == 'allievo')
            $tessera->corso_acquistato = $corso_acquistato->id;
        $tessera->note = $request->note;
        $tessera->saveOrFail();

        $utente = new User();

        //salvataggio dell'utente dell'admin
        $utente->tessera_id = $tessera->id;
        $utente->email = $request->email;
        $password = str_random(12);
        $utente->password = bcrypt($password);
        if($tessera->ruolo_societario == 'ordinario' && $tessera->ruolo_sportivo== 'allievo')
            $utente->tipo_admin = 'utente';
        else if (($tessera->ruolo_societario == 'presidente' ||
            $tessera->ruolo_societario == 'vicepresidente' ||
            $tessera->ruolo_societario == 'dirigente' ||
            $tessera->ruolo_societario == 'segretario') && $tessera->ruolo_sportivo != 'allievo')
            $utente->tipo_admin = 'admin';
        else if (($tessera->ruolo_societario == 'presidente' ||
                $tessera->ruolo_societario == 'vicepresidente' ||
                $tessera->ruolo_societario == 'dirigente' ||
                $tessera->ruolo_societario == 'segretario') && $tessera->ruolo_sportivo != 'insegnante')
            $utente->tipo_admin = 'admin';
        else if (($tessera->ruolo_societario == 'presidente' ||
                $tessera->ruolo_societario == 'vicepresidente' ||
                $tessera->ruolo_societario == 'dirigente' ||
                $tessera->ruolo_societario == 'segretario') && $tessera->ruolo_sportivo == 'allievo')
            $utente->tipo_admin = 'admin_utente';
        else
            $utente->tipo_admin = ' ';

        $utente->saveOrFail();

        $socio = new Socio();

        //salvataggio del socio
        $socio->codice_fiscale = $request['codice_fiscale'];
        $socio->tessera_id = $tessera->id;
        $socio->utente_id = $utente->id;
        $socio->saveOrFail();

        if($tessera->ruolo_sportivo == 'allievo') {

            return view('transazioni.create')
                ->with('tessera', $tessera)
                ->with('socio', $socio)
                ->with('utente', $utente)
                ->with('password_in_chiaro', $password)
                ->with('in_entrata', 1)
                ->with('inaccessibile', 0);
        } else {

            if($tessera->ruolo_sportivo == 'insegnante' && ($tessera->ruolo_societario == 'ordinario' ||
                    $tessera->ruolo_societario == 'collaboratore') || $tessera->ruolo_societario == 'collaboratore')
                return view('soci.completamento')->with('utente', $utente)->with('password_in_chiaro', $password)
                    ->with('inaccessibile', 1);
            else
                return view('soci.completamento')->with('utente', $utente)->with('password_in_chiaro', $password)
                    ->with('inaccessibile', 0);
        }
    }

    public function show($id) {

        //cerca il socio
        $tessera = Tessera::find($id);

        $corso_acquistato = NULL;

        if($tessera->corso_acquistato != NULL){

            $corso_acquistato = DB::table('corsi_acquistati')
                ->where('corsi_acquistati.id', $tessera->corso_acquistato)
                ->join('pacchetti_corsi', 'pacchetti_corsi.id', '=', 'corsi_acquistati.pacchetto_acquistato')
                ->first();
        }

        $socio = DB::table('soci')->where('tessera_id', $tessera->id)->first();

        $indirizzo = DB::table('indirizzi')->where('id', $tessera->indirizzo_id)->first();

        $utente = DB::table('users')->where('tessera_id', $tessera->id)->first();

        //chiamata della lista di stampa delle info
        return view('soci.show')
            ->with('socio', $socio)
            ->with('tessera', $tessera)
            ->with('indirizzo', $indirizzo)
            ->with('utente',$utente)
            ->with('corso_acquistato', $corso_acquistato);
    }

    public function edit($id) {

        $tessera = Tessera::find($id);

        $socio = DB::table('soci')->where('tessera_id', $id)->first();

        $utente = DB::table('users')->where('tessera_id', $id)->first();

        $indirizzo = DB::table('indirizzi')->where('id', $tessera->indirizzo_id)->first();

        return view('soci.edit')
            ->with('tessera', $tessera)
            ->with('socio', $socio)
            ->with('utente', $utente)
            ->with('indirizzo', $indirizzo);
    }

    public function update(Request $request, $id){

        $request->validate([
            'nome' => 'required',
            'cognome' => 'required',
            'email' => 'required',
            'via' => 'required',
            'numero_civico' => 'required',
            'citta' => 'required',
            'sesso' => 'required',
            'luogo_nascita' => 'required',
            'data_nascita' => 'required',
            'numero_telefono' => 'required',
            'ruolo_societario' => 'required',
            'ruolo_sportivo' => 'required',
        ]);

        //controllo della correttezza delle date
        if($request->data_nascita > date('Y-m-d')) {

            $request->session()->flash('errore','ERRORE! La data è errata');

            return view('soci.update');
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


        //controllo dell'esistenza della mail
        if(($utente = DB::table('users')->where('email', $request->email)->first()) != NULL) {

            //se rispetta questa condizione vuol dire che qualcun altro ha lo stesso codice fiscale
            if ($utente->tessera_id != $id) {

                $request->session()->flash('errore','ERRORE! La mail inserita esiste già');

                return view('soci.update');
            }
        } else {

            $ut = DB::table('users')->where('tessera_id', $id)->first();
            $utente = User::find($ut->id);
            $utente->email = $request->email;
            $utente->saveOrFail();
        }

        $id_corso_acquistato_da_cancellare = NULL;

        $tessera = Tessera::find($id);

        if($request->ruolo_sportivo == 'allievo' && $tessera->corso_acquistato == NULL) {

            $corso_acquistato = new Corso_Acquistato();

            $corso_acquistato->pacchetto_acquistato = NULL;
            $corso_acquistato->data_inizio_corso = '1900-01-01';    //valore di dafault
            $corso_acquistato->data_fine_corso = '1900-01-01';      //valore di default
            $corso_acquistato->saveOrFail();
        } elseif ($request->ruolo_sportivo != 'allievo' && $tessera->corso_acquistato != NULL) {

            $id_corso_acquistato_da_cancellare = $tessera->corso_acquistato;
        }

        $socio = DB::table('soci')->where('tessera_id', $tessera->id)->first();
        $lista_corsi = NULL;

        if(DB::table('corsi')->where('insegnante_id', $socio->codice_fiscale)->count() > 0){

            $lista_corsi = DB::table('corsi')->where('insegnante_id', $socio->codice_fiscale)->get();
        }

        $tessera->nome = $request->nome;
        $tessera->cognome = $request->cognome;
        $tessera->indirizzo_id = $indirizzo->id;
        $tessera->sesso = $request->sesso;
        $tessera->luogo_nascita = $request->luogo_nascita;
        $tessera->data_nascita = $request->data_nascita;
        $tessera->numero_telefono = $request->numero_telefono;
        $tessera->ruolo_societario = $request->ruolo_societario;
        $tessera->ruolo_sportivo = $request->ruolo_sportivo;
        if($request->ruolo_sportivo == 'allievo' && $tessera->corso_acquistato == NULL)
            $tessera->corso_acquistato = $corso_acquistato->id;
        elseif ($request->ruolo_sportivo != 'allievo' && $tessera->corso_acquistato != NULL)
            $tessera->corso_acquistato = NULL;
        $tessera->note = $request->note;
        $tessera->saveOrFail();

        if($id_corso_acquistato_da_cancellare != NULL)
            Corso_Acquistato::destroy($id_corso_acquistato_da_cancellare);

        if($lista_corsi != NULL){

            foreach ($lista_corsi as $cor){

                $corso = Corso::find($cor->id);
                $corso->insegnante_id = NULL;
                $corso->save();
            }
        }

        $request->session()->flash('successo','Socio modificato con successo');


        $lista_soci = Tessera::all();

        return view('soci.index')->with('lista_soci', $lista_soci);

    }

    public function destroy($id) {

        $tessera = Tessera::find($id);

        $socio = DB::table('soci')->where('tessera_id', $id)->first();

        $lista_corsi = NULL;

        if($tessera->ruolo_sportivo == 'insegnante' &&
            DB::table('corsi')->where('insegnante_id', $socio->codice_fiscale)->count() > 0){

            $lista_corsi = DB::table('corsi')->where('insegnante_id', $socio->codice_fiscale)->get();
        }

        if($lista_corsi != NULL){

            foreach ($lista_corsi as $cor){

                $corso = Corso::find($cor->id);
                $corso->insegnante_id = NULL;
                $corso->save();
            }
        }

        DB::table('soci')->where('tessera_id', $id)->delete();

        DB::table('users')->where('tessera_id', $id)->delete();

        DB::table('corsi_acquistati')->where('id', $tessera->corsi_acquistati)->delete();

        $tessera->delete();

        $lista_soci = Tessera::all();

        return view('soci.index')->with('lista_soci', $lista_soci);
    }

    public function aggiornamento_tessera($id) {

        $COSTO_RINNOVO_TESSERA = 10;

        $tessera = Tessera::find($id);

        $tessera->scadenza = date('Y-m-d', strtotime('+1 years'));
        $tessera->saveOrFail();

        $socio = DB::table('soci')->where('tessera_id',$tessera->id)->first();

        $transazione = new Transazione();

        //salvataggio delle tessere
        $transazione->numero_documento_fiscale = date('YmdHis');
        $transazione->tipo_documento_fiscale = 'ricevuta_fiscale';
        $transazione->importo = $COSTO_RINNOVO_TESSERA;
        $transazione->causale = "Rinnovo della tessera";
        $transazione->data_erogazione = date('Y-m-d');
        $transazione->modalita_pagamento = 'contanti';
        $transazione->in_entrata = 1;
        $transazione->codice_fiscale_soggetto_transazione = $socio->codice_fiscale;
        $transazione->saveOrFail();

        return view('soci.aggiornamento_tessera');
    }

    public function aggiornamento_assicurazione($id) {

        $COSTO_RINNOVO_ASSICURAZIONE = 10;

        $tessera = Tessera::find($id);

        $tessera->data_inizio_assicurazione = date('Y-m-d');
        $tessera->data_fine_assicurazione = date('Y-m-d', strtotime('+1 years'));
        $tessera->saveOrFail();

        $socio = DB::table('soci')->where('tessera_id',$tessera->id)->first();

        $transazione = new Transazione();

        //salvataggio delle tessere
        $transazione->numero_documento_fiscale = date('YmdHis');
        $transazione->tipo_documento_fiscale = 'ricevuta_fiscale';
        $transazione->importo = $COSTO_RINNOVO_ASSICURAZIONE;
        $transazione->causale = "Rinnovo dell'assicurazione";
        $transazione->data_erogazione = date('Y-m-d');
        $transazione->modalita_pagamento = 'contanti';
        $transazione->in_entrata = 1;
        $transazione->codice_fiscale_soggetto_transazione = $socio->codice_fiscale;
        $transazione->saveOrFail();

        return view('soci.aggiornamento_assicurazione');
    }

    public function aggiornamento_certificato($id) {

        $tessera = Tessera::find($id);

        $tessera->data_inizio_certificato_medico = date('Y-m-d');
        $tessera->data_fine_certificato_medico = date('Y-m-d', strtotime('+6 months'));
        $tessera->saveOrFail();

        return view('soci.aggiornamento_certificato');
    }

    public function transazione($id) {

        $tessera = DB::table('tessere')->where('id', $id)->first();

        $socio = DB::table('soci')->where('tessera_id', $id)->first();

        return view('soci.transazione')->with('socio', $socio)->with('tessera', $tessera);
    }

    public function rinnovo_pacchetto ($id) {

        $tessera = DB::table('tessere')
            ->where('corso_acquistato', $id)
            ->first();

        $socio = DB::table('soci')->where('tessera_id', $tessera->id)->first();

        $corso_acquistato = Corso_Acquistato::find($id);

        $corso_acquistato->data_fine_corso = date('Y-m-d', strtotime('+1 months'));
        $corso_acquistato->saveOrFail();

        $pacchetto = Pacchetto::find($corso_acquistato->pacchetto_acquistato);

        $transazione = new Transazione();

        //salvataggio delle transazioni
        $transazione->numero_documento_fiscale = date('YmdHis');
        $transazione->tipo_documento_fiscale = 'ricevuta fiscale';
        $transazione->importo = $pacchetto->prezzo;
        $transazione->causale = "Rinnovo del corso";
        $transazione->data_erogazione = date('Y-m-d');
        $transazione->modalita_pagamento = 'contanti';
        $transazione->in_entrata = 1;
        $transazione->codice_fiscale_soggetto_transazione = $socio->codice_fiscale;
        $transazione->saveOrFail();

        return view('soci.rinnova_pacchetto')
            ->with('prezzo', $pacchetto->prezzo);
    }

    public function modifica_pacchetto (Request $request) {

        $tessera = Tessera::find($request->tessera_id);

        $socio = DB::table('soci')->where('tessera_id', $request->tessera_id)->first();

        $corso_acquistato = Corso_Acquistato::find($tessera->id);

        $corso_acquistato->pacchetto_acquistato = $request->pacchetto_acquistato;
        $corso_acquistato->save;

        return view('soci.transazione_rinnovo')
            ->with('socio', $socio)
            ->with('tessera', $tessera);
    }
}
