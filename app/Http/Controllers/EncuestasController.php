<?php

namespace App\Http\Controllers;

use App\Encuesta;
use App\Formatos_respuesta;
use App\Pregunta;
use Illuminate\Http\Request;

class EncuestasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $encuestas=Encuesta::all()->sortBy("nombre"); // obtiene en forma ordenada
         return view('encuestas.index', compact('encuestas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('encuestas.create');
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
            'nombre' => 'required'
        ]);
        // return 'Aqui tengo guardar';
        $encuesta=new Encuesta;
        $encuesta->nombre = $request->input('nombre');
        $encuesta->save();
        return redirect()->route('encuestas.edit', $encuesta->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $encuesta = Encuesta::findOrFail($id);
        //dd($encuesta->preguntas());
        $formatos = Formatos_respuesta::pluck('formato','id');
        return view('encuestas.edit', compact('encuesta','formatos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $encuesta = Encuesta::findOrFail($id);
        $encuesta->nombre = $request->input('nombre');
        $encuesta->update();
        return redirect()->route('encuestas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $encuesta = Encuesta::findOrFail($id);
        $encuesta->delete();
        return redirect()->route('encuestas.index');
    }
}
