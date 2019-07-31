<?php

namespace ASD_Aphrodite;

use Illuminate\Database\Eloquent\Model;

class Pacchetto extends Model
{
    protected $table = 'pacchetti_corsi';

    public function corso_acquistato(){
        return $this->belongsTo('App\Corso_Acquistato');
    }

    public function corso_I(){
        return $this->hasOne('App\Corso');
    }

    public function corso_II(){
        return $this->hasOne('App\Corso');
    }

    public function corso_III(){
        return $this->hasOne('App\Corso');
    }
}
