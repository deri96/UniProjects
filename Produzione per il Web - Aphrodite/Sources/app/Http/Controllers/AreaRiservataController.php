<?php

namespace ASD_Aphrodite\Http\Controllers;

use Illuminate\Http\Request;

class AreaRiservataController extends Controller
{
    public function index () {

        return view('area_riservata.home');
    }

    public function admin () {

        return view('admin');
    }

    public function utente () {

        return view('utente');
    }
}
