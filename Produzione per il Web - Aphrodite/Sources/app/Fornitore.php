<?php

namespace ASD_Aphrodite;

use Illuminate\Database\Eloquent\Model;

class Fornitore extends Model
{
    protected $table = 'fornitori';

    public function transazione(){
        return $this->belongsTo('App\Transazione');
    }

    public function indirizzo(){
        return $this->hasOne('App\Indirizzo');
    }
}
