<?php

namespace ASD_Aphrodite\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class DocumentiController extends Controller
{
    public function __construct() {

        $this->middleware('accessoAdmin');
    }

    public function modulo_iscrizione () {

        $data = ['title' => 'Modulo di iscrizione + liberatoria delle immagini'];
        $pdf = PDF::loadView('documenti.modulo_iscrizione_liberatoria_immagine', $data);

        return $pdf->download('modulo_iscrizione_liberatoria_immagine.pdf');
    }

    public function ricevuta_pagamento () {

        $data = ['title' => 'Ricevuta di pagamento'];
        $pdf = PDF::loadView('documenti.ricevuta_pagamento', $data);

        return $pdf->download('ricevuta_pagamento.pdf');
    }

    public function ricevuta_iscrizione_minorenne () {

        $data = ['title' => 'Ricevuta di iscrizione del minorenne'];
        $pdf = PDF::loadView('documenti.ricevuta_iscrizione_minorenne', $data);

        return $pdf->download('ricevuta_iscrizione_minorenne.pdf');
    }

    public function richiesta_iscrizione_consiglio_direttivo () {

        $data = ['title' => 'Richiesta di iscrizione al consiglio direttivo'];
        $pdf = PDF::loadView('documenti.richiesta_iscrizione_consiglio_direttivo', $data);

        return $pdf->download('richiesta_iscrizione_consiglio_direttivo.pdf');
    }
}
