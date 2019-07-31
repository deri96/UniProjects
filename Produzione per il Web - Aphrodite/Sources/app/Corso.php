<?php

namespace ASD_Aphrodite;

use Illuminate\Database\Eloquent\Model;

class Corso extends Model
{
    protected $table = 'corsi';


    public function insegnante_id(){
        return $this->hasOne('App\Socio');
    }

    public function stagista_id(){
        return $this->hasOne('App\Stagista');
    }

    public function disciplina_id() {
        return $this->hasOne('App\Disciplina');
    }

    public function calendario(){
        return $this->belongsTo('App\Calendario');
    }

    public function pacchetto(){
        return $this->belongsTo('App\Pacchetto');
    }
}
