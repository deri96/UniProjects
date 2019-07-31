<?php

namespace ASD_Aphrodite;

use Illuminate\Database\Eloquent\Model;

class Corso_Acquistato extends Model
{
    protected $table = 'corsi_acquistati';

    public function tessera(){
        return $this->belongsTo('App\Tessera');
    }

    public function pacchetto(){
        return $this->hasOne('App\Pacchetto');
    }
}
