<?php

namespace App\Http\Controllers;

use App\Formatos_respuesta;
use App\Valores_respuesta;
use Illuminate\Http\Request;

class ValoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $formato = Formatos_respuesta::find($request->formato);
        return view('valores_respuestas.create', compact('formato'));
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
            'respuesta' => 'required',
            'valor' => 'required|numeric'
        ]);

        $respuesta = $request->input('respuesta');
        $valor_resp= $request->input('valor');
        $formatos_respuesta_id = $request->formato;

        $valor = new Valores_respuesta;
        $valor->respuesta = $respuesta;
        $valor->valor = $valor_resp;
        $valor->formatos_respuesta_id = $formatos_respuesta_id;
        $valor->save();

        return redirect()->route('formatos_respuestas.edit',$formatos_respuesta_id)->with('info', 'Se agregó correctamente');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Valores_respuesta  $valores_respuesta
     * @return \Illuminate\Http\Response
     */
    public function show(Valores_respuesta $valores_respuesta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Valores_respuesta  $valores_respuesta
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $valor= Valores_respuesta::find($id);
        return view('valores_respuestas.edit', compact('valor'));
    }//

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Valores_respuesta  $valores_respuesta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'respuesta' => 'required',
            'valor' => 'required|numeric'
        ]);

        $respuesta = $request->input('respuesta');
        $valor_resp= $request->input('valor');

        $valor = Valores_respuesta::find($id);
        $valor->respuesta = $respuesta;
        $valor->valor = $valor_resp;
        $valor->update();

        return redirect()->route('formatos_respuestas.edit',$valor->formatos_respuesta_id)->with('info', 'Se Guardó correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Valores_respuesta  $valores_respuesta
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $valor=Valores_respuesta::find($id);
        $formato_id = $valor->formatos_respuesta_id;
        // dd($valor);
        $valor->delete();
        return redirect()->route('formatos_respuestas.edit',compact('formato_id'))->with('info', 'se eliminó correctamente');
    }

}
