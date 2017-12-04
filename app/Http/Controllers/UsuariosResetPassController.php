<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsuariosResetPassController extends Controller
{
    public function blanquear($id)
    {
    	$usuario = User::find($id);
    	// $np = substr(md5(microtime(true)), 0, 5);
    	$usuario->password = bcrypt('123123');
    	$usuario->update();

    	return redirect()->route('usuarios.edit', $id)->with('info', 'Se Blanqueo el Password - NP=123123');
    }
}
