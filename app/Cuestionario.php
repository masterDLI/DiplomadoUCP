<?php

namespace App;

use App\Encuesta;
use App\Respuesta;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cuestionario extends Model
{
    use SoftDeletes;

    public function respuestas()
    {
    	return $this->hasMany(Respuesta::class)->get();
    }

    public function encuesta()
    {
    	return $this->belongsTo(Encuesta::class)->first();
    }


}//
