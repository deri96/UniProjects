<?php

namespace ASD_Aphrodite;

use Illuminate\Database\Eloquent\Model;

class Stagista extends Model
{
    protected $table = 'stagisti';

    public function indirizzo(){
        return $this->hasOne('App\Indirizzo');
    }

    public function corso(){
        return $this->belongsTo('App\Corso');
    }
}
