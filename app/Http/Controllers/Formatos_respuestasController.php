<?php

namespace App\Http\Controllers;

use App\Formatos_respuesta;
use Illuminate\Http\Request;

class Formatos_respuestasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $formatos = Formatos_respuesta::all();
        return view('formatos_respuestas.index', compact('formatos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('formatos_respuestas.create');
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
            'formato' => 'required'
        ]);

        $nombre_formato = $request->input('formato');

        $formato = new Formatos_respuesta;
        $formato->formato = $nombre_formato;
        $formato->save();

        return redirect()->route('formatos_respuestas.edit', $formato->id)->with('info','Se creó correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Formatos_respuesta  $formatos_respuesta
     * @return \Illuminate\Http\Response
     */
    public function show(Formatos_respuesta $formatos_respuesta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Formatos_respuesta  $formatos_respuesta
     * @return \Illuminate\Http\Response
     */
    public function edit(Formatos_respuesta $formatos_respuesta)
    {
        $valores = $formatos_respuesta->valores();
        $formato = $formatos_respuesta;
        return view('formatos_respuestas.edit', compact('formato', 'valores'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Formatos_respuesta  $formatos_respuesta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Formatos_respuesta $formatos_respuesta)
    {
        $this->validate($request, [
            'formato' => 'required'
        ]);

        $nombre_formato = $request->input('formato');
        $formatos_respuesta->formato = $nombre_formato;
        $formatos_respuesta->update();

        return redirect()->route('formatos_respuestas.index')->with('info','Se Acualizó correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Formatos_respuesta  $formatos_respuesta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Formatos_respuesta $formatos_respuesta)
    {
       // dd($formatos_respuesta);
       $formatos_respuesta->delete();
       return redirect()->route('formatos_respuestas.index')->with('info','Se eliminó correctamente');

    }
}
