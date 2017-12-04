<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Aplicacion extends Model
{
    use SoftDeletes;

    public function perfil()
    {
    	return $this->belongsToMany(Perfil::class, 'aplicacion_perfils');
    }
}
