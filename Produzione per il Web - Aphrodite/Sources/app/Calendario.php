<?php

namespace ASD_Aphrodite;

use Illuminate\Database\Eloquent\Model;

class Calendario extends Model
{
    protected $table = 'calendari';

    public function sala(){
        return $this->belongsTo('App\Sala');
    }

    public function corso(){
        return $this->belongsTo('App\Corso');
    }
}
