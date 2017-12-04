<?php

namespace App\Http\Controllers;

use App\Cuestionario;
use App\Encuesta;
use App\Formatos_respuesta;
use App\Respuesta;
use App\Resultado;
use App\Valores_respuesta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\collect;

class CuestionariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $encuestas=Encuesta::all()->sortBy("nombre"); // obtiene en forma ordenada
        return view('cuestionarios.index', compact('encuestas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $encuesta_id = $request->id;

        $cuestionario = new Cuestionario;
        $cuestionario->encuesta_id = $encuesta_id;
        $cuestionario->usuario_id = auth()->user()->id;
        $cuestionario->estado = 0;
        $cuestionario->save();

        $preguntas = Encuesta::find($encuesta_id)->preguntas();

        foreach ($preguntas as $pregunta) {
            $respuesta = new Respuesta;
            $respuesta->cuestionario_id = $cuestionario->id;
            $respuesta->pregunta_id = $pregunta->id;
            $respuesta->save();
        }
        return redirect()->route('cuestionarios.edit', compact('cuestionario', 'preguntas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cuestionario  $cuestionario
     * @return \Illuminate\Http\Response
     */
    public function show(Cuestionario $cuestionario)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cuestionario  $cuestionario
     * @return \Illuminate\Http\Response
     */
    public function edit(Cuestionario $cuestionario)
    {

        // $formatos = Formatos_respuesta::all();
        // $preguntas = DB::table('preguntas')
        //         ->join('formatos_respuestas', 'preguntas.formatos_respuesta_id','=', 'formatos_respuestas.id')
        //         ->select('preguntas.id', 'preguntas.pregunta', 'formatos_respuestas.id as formato_id', 'formatos_respuestas.formato')
        //         ->where('preguntas.encuesta_id','=',$cuestionario->encuesta_id)
        //         ->get();

        $respuestas = DB::table('respuestas')
                ->join('preguntas', 'preguntas.id','=','respuestas.pregunta_id')
                ->join('formatos_respuestas','formatos_respuestas.id','=','preguntas.formatos_respuesta_id')
                ->select('respuestas.id','preguntas.pregunta','preguntas.ponderacion', 'formatos_respuestas.id as formato_id', 'formatos_respuestas.formato','valor_id')
                ->where('respuestas.cuestionario_id','=',$cuestionario->id)
                ->get();

        // return  $respuestas;
        $valores = Valores_respuesta::all();

        return view('cuestionarios.edit',compact('cuestionario','respuestas', 'valores'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cuestionario  $cuestionario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cuestionario $cuestionario)
    {
        $this->validate($request, [
            'cliente' => 'required'
        ]);

        $resultados = Resultado::find($cuestionario->encuesta_id)->get();
        $resultado_cuestionario = 0;
        $valor_resultado = $request->resultado;

        foreach ($resultados as $resultado) {
            if ($resultado->minimo <= $valor_resultado AND $resultado->maximo >= $valor_resultado) {
                $resultado_cuestionario = $resultado->id;
            }
        }

        $cliente = $request->cliente;
        $estado = $request->estado;

        $cuestionario->cliente = $cliente;
        $cuestionario->estado = $estado;
        $cuestionario->resultado_id = $resultado_cuestionario;
        $cuestionario->update();

        $respuestas = $request->respuestas;
        foreach ($respuestas as $id => $value) {
            $respuesta = Respuesta::find($id);
            $respuesta->valor_id = $respuestas[$id][0];
            $respuesta->update();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cuestionario  $cuestionario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cuestionario $cuestionario)
    {
        //
    }
}
