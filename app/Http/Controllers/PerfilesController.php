<?php

namespace App\Http\Controllers;

use App\Aplicacion;
use App\Perfil;
use Illuminate\Http\Request;

class PerfilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perfiles=Perfil::all();
        return view('perfiles.index', compact('perfiles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $perfil=new Perfil;
        $aplicaciones = Aplicacion::pluck('aplicacion','id');
        return view('perfiles.create',compact('aplicaciones','perfil'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'perfil' => 'required',
        ]);

        $perfil_nombre=$request->perfil;
        $perfil = new Perfil;
        $perfil->perfil=$perfil_nombre;
        $perfil->save();
        $perfil->aplicaciones()->sync($request->aplicaciones);
        return redirect()->route('perfiles.index')->with('info','Se Agregó correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function show(Perfil $perfil)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $perfil = Perfil::find($id);
        $aplicaciones = Aplicacion::pluck('aplicacion','id');
        return view('perfiles.edit', compact('perfil', 'aplicaciones'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        $this->validate($request, [
            'perfil' => 'required',
        ]);
        $perfil = Perfil::find($id);
        $perfil->perfil=$request->input('perfil');
        $perfil->update();
        $perfil->aplicaciones()->sync($request->aplicaciones);
        return redirect()->route('perfiles.index')->with('info','Se guardó correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $perfil = Perfil::find($id);
        $perfil->delete();
        return redirect()->route('perfiles.index')->with('info','Se eliminó correctamente');
    }
}
