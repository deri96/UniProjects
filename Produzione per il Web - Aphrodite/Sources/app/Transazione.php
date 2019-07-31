<?php

namespace ASD_Aphrodite;

use Illuminate\Database\Eloquent\Model;

class Transazione extends Model
{
    protected $table = 'transazioni';

    public function fornitore(){
        return $this->hasOne('App\Fornitore');
    }
}
