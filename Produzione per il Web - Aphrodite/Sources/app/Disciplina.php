<?php

namespace ASD_Aphrodite;

use Illuminate\Database\Eloquent\Model;

class Disciplina extends Model
{
    protected $table = 'discipline';

    public function corso(){
        return $this->hasMany('App\Corso');
    }
}
