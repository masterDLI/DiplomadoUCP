<?php

namespace App;

use App\Perfil;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function aplicaciones()
    {
        $aplicaciones =  Perfil::find($this->perfil_id)->aplicaciones->sortBy('aplicacion');
        return $aplicaciones;
    }


    public function perfil()
    {
        return $this->belongsTo(Perfil::class)->first();
    }


    public function tienePerfil(array $perfiles)
    {
        foreach ($perfiles as $perfil) {
            if ($this->perfil_id == $perfil) {
               return true;
            }
        }
        return false;
    }


}
