<?php

namespace ASD_Aphrodite;

use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
    protected $table = 'sale';

    public function calendario(){
        return $this->belongsTo('App\Calendario');
    }
}
