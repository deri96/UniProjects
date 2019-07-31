<?php

namespace ASD_Aphrodite;

use Illuminate\Database\Eloquent\Model;

class Socio extends Model
{
    protected $table = 'soci';

    public function tessera_id(){
        return $this->hasOne('App\Tessera');
    }

    public function corso(){
        return $this->belongsTo('App\Corso');
    }

}
