<?php

namespace App;

use App\Valores_respuesta;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Formatos_respuesta extends Model
{
    use SoftDeletes;

    public function valores(){
    	return $this->hasMany(Valores_respuesta::class)->get();
    }

}
