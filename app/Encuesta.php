<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Encuesta extends Model
{
	use SoftDeletes;

    public function preguntas()
    {
        return $this->hasMany('App\Pregunta')->get();
    }

    public function resultados()
    {
    	return $this->hasMany('App\Resultado')->get();
    }
}
