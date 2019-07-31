<?php

namespace ASD_Aphrodite;

use Illuminate\Database\Eloquent\Model;

class Tessera extends Model
{
    protected $table = 'tessere';

    public function indirizzo(){
        return $this->hasOne('App\Indirizzo');
    }

    public function corso_acquistato(){
        return $this->hasOne('App\Corso_Acquistato');
    }

    public function collaboratore(){
        return $this->belongsTo('App\Collaboratore');
    }

    public function socio(){
        return $this->belongsTo('App\Socio');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}
