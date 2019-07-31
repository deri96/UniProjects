<?php

namespace ASD_Aphrodite;

use Illuminate\Database\Eloquent\Model;

class Indirizzo extends Model
{

    protected $table = 'indirizzi';

    public function tessera(){
        return $this->belongsTo('App\Tessera');
    }

    public function stagista() {
        return $this->belongsTo('App\Stagista');
    }

    public function fornitore(){
        return $this->belongsTo('App\Fornitore');
    }

    public function sede_lavorativa(){
        return $this->hasOne('App\Fornitore');
    }

    public function app_cittadina(){
        return $this->belongsTo('App\Citta');
    }
}
