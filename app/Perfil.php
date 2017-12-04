<?php

namespace App;

use App\Aplicacion;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Perfil extends Model
{
	use SoftDeletes;
    protected $table='perfiles';

    public function user()
    {
    	return $this->hasMany(User::class);
    }

    public function aplicaciones()
    {
    	return $this->belongsToMany(Aplicacion::class, 'aplicacion_perfils');
    }

}
