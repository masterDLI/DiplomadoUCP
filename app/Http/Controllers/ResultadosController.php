<?php

namespace App\Http\Controllers;

use App\Encuesta;
use App\Resultado;
use Illuminate\Http\Request;

class ResultadosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $encuesta = Encuesta::find($request->id);
        $resultados = $encuesta->resultados();
        return view('resultados.index',compact('encuesta', 'resultados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $nombre=$request->encuesta;
        $encuesta = Encuesta::where('nombre', $nombre)->first();
        return view('resultados.create')->with(['encuesta' => $encuesta]);
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
            'mínimo' => 'required|numeric',
            'máximo' => 'required|numeric',
            'resultado' => 'required'
        ]);

        $encuesta_id = $request->encuesta_id;
        $minimo = $request->mínimo;
        $maximo = $request->máximo;
        $result= $request->resultado;

        $resultado = new Resultado;
        $resultado->minimo = $minimo;
        $resultado->maximo = $maximo;
        $resultado->resultado = $result;
        $resultado->encuesta_id = $encuesta_id;
        $resultado->save();

        return redirect()->route('resultados.index', ['id'=>$encuesta_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Resultado  $resultado
     * @return \Illuminate\Http\Response
     */
    public function show(Resultado $resultado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Resultado  $resultado
     * @return \Illuminate\Http\Response
     */
    public function edit(Resultado $resultado)
    {
        $encuesta = $resultado->encuesta();
        return view('resultados.edit', compact('resultado', 'encuesta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Resultado  $resultado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Resultado $resultado)
    {
        $this->validate($request, [
            'mínimo' => 'required|numeric',
            'máximo' => 'required|numeric',
            'resultado' => 'required'
        ]);

        $minimo = $request->mínimo;
        $maximo = $request->máximo;
        $result= $request->resultado;

        $resultado->minimo = $minimo;
        $resultado->maximo = $maximo;
        $resultado->resultado = $result;
        $resultado->update();

        return redirect()->route('resultados.index', ['id'=>$resultado->encuesta_id]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Resultado  $resultado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Resultado $resultado)
    {
        $encuesta_id=$resultado->encuesta_id;
        $resultado->delete();
        return redirect()->route('resultados.index', ['id'=> $encuesta_id]);
    }
}
