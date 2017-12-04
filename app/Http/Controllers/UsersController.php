<?php

namespace App\Http\Controllers;

use App\Perfil;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = User::orderBy('name')->get();
        $perfiles = Perfil::all();
        return view('usuarios.index', compact('usuarios', 'perfiles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $perfiles=Perfil::orderBy('perfil')->get();

        return view('usuarios.create', compact('perfiles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'nombre' => 'required',
            'perfil' => 'required|numeric',
            'email'  => 'email'
        ]);

        $nombre = $request->nombre;
        $perfil = $request->perfil;
        $email = $request->email;

        $usuario = new User;
        $usuario->name = $nombre;
        $usuario->perfil_id = $perfil;
        $usuario->email = $email;
        $usuario->password = bcrypt('123123');
        $usuario->save();

        $usuarios = User::orderBy('name')->get();
        $perfiles = Perfil::all();
        return redirect()->route('usuarios.index',compact('usuarios', 'perfiles'))->with('info','Se agregó correctamente el usuario '.$nombre);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if ($id == 1) {
            return redirect()->route('usuarios.index')->with(['info'=>'El Usuario Admin no se puede Editar','tipo'=>'info-error']);
        }else{
            $usuario = User::find($id);
            $perfiles = Perfil::all();
            return view('usuarios.edit', compact('usuario','perfiles'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'nombre' => 'required',
            'perfil' => 'required|numeric',
            'email'  => 'email'
        ]);

        $nombre = $request->nombre;
        $perfil = $request->perfil;
        $email = $request->email;

        $usuario = User::find($id);
        $usuario->name = $nombre;
        $usuario->perfil_id = $perfil;
        $usuario->email = $email;
        $usuario->update();

        $usuarios = User::orderBy('name')->get();
        $perfiles = Perfil::all();
        return redirect()->route('usuarios.index',compact('usuarios', 'perfiles'))->with('info','Se Guardó correctamente el usuario '.$nombre);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        if ($id == 1) {
            return redirect()->route('usuarios.index')->with(['info'=>'El Usuario Admin no se puede Eliminar','tipo'=>'info-error']);
        }else{
            $usuario=User::find($id);
            $usuario->delete();
            return redirect()->route('usuarios.index')->with(['info'=>'El Usuario se eliminó correctamente','tipo'=>'info']);
        }
    }
}
