<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Aplicacion_perfil extends Pivot
{
    protected $table='aplicacion_perfils';
}
