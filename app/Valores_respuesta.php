<?php

namespace App;

use App\Formatos_respuesta;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Valores_respuesta extends Model
{
    use SoftDeletes;

    public function formato(){
		return $this->belongsTo('App\Formatos_respuesta')->first();
    }

}
