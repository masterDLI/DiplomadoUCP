<?php

namespace App;

use App\Encuesta;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Respuesta extends Model
{
    use SoftDeletes;

    public function encuesta(){
    	return $this->belongsTo('Encuesta');
    }

}
