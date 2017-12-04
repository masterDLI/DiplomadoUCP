<?php

namespace App;

use App\Formatos_respuesta;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pregunta extends Model
{
	use SoftDeletes;

    public function encuesta()
    {
        return $this->belongsTo('App\Encuesta')->first();
    }

    public function formato()
    {
    	return $this->belongsTo(Formatos_respuesta::class);
    }
}
