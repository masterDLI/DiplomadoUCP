<?php

namespace App\Http\Controllers;

use App\Aplicacion;
use Illuminate\Http\Request;

class AplicacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aplicaciones = Aplicacion::orderBy('aplicacion')->get();
        return view('aplicaciones.index', compact('aplicaciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('aplicaciones.create');
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
            'aplicación' => 'required',
            'url' => 'required'
        ]);
        // return 'Aqui tengo guardar';
        $aplicacion=new Aplicacion;
        $aplicacion->aplicacion = $request->input('aplicación');
        $aplicacion->url = $request->input('url');
        $aplicacion->save();
        return redirect()->route('aplicaciones.index')->with('info', 'Se agregó correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Aplicacion  $aplicacion
     * @return \Illuminate\Http\Response
     */
    public function show(Aplicacion $aplicacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Aplicacion  $aplicacion
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $aplicacion= Aplicacion::find($id);
        return view('aplicaciones.edit',compact('aplicacion'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Aplicacion  $aplicacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'aplicación' => 'required',
            'url' => 'required'
        ]);
        // return 'Aqui tengo guardar';
        $aplicacion=Aplicacion::find($id);
        $aplicacion->aplicacion = $request->input('aplicación');
        $aplicacion->url = $request->input('url');
        $aplicacion->update();
        return redirect()->route('aplicaciones.index')->with('info', 'Se Editó correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Aplicacion  $aplicacion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $aplicacion=Aplicacion::find($id);
        $aplicacion->delete();
        return redirect()->route('aplicaciones.index')->with('info', 'Se Eliminó correctamente');

    }
}
