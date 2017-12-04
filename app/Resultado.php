<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Resultado extends Model
{
    use SoftDeletes;

    public function encuesta(){
    	 return $this->belongsTo('App\Encuesta')->first();
    }

}
