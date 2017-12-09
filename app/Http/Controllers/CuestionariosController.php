<?php

namespace App\Http\Controllers;

use App\Cuestionario;
use App\Encuesta;
use App\Formatos_respuesta;
use App\Notificacion;
use App\Respuesta;
use App\Resultado;
use App\Valores_respuesta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\collect;

class CuestionariosController extends Controller
{

    public function estadistica(Request $request){



        $encuesta= Encuesta::find($request->encuesta);
        $cuestionarios = DB::table('cuestionarios')
        ->join('users','users.id','=','cuestionarios.usuario_id')
        ->leftJoin('resultados','resultados.id','=','cuestionarios.resultado_id')
        ->select('cuestionarios.id','cuestionarios.created_at', 'cuestionarios.cliente', 'users.name as encuestador','cuestionarios.estado','resultados.resultado','cuestionarios.valor_resultado')
        ->where('cuestionarios.estado','=','1')
        ->orderBy('cuestionarios.id', 'desc')
        ->limit(10)
        ->get();

        $cuestionarios = $cuestionarios->reverse();

        $promedio = number_format($cuestionarios->avg('valor_resultado'),2);

        $resultados = Resultado::find($encuesta->id)->get();
        $resultado_cuestionario = '';

        foreach ($resultados as $resultado) {
            if ($resultado->minimo <= $promedio AND $resultado->maximo >= $promedio) {
                $resultado_cuestionario = $resultado->resultado;
            }
        }

        // return $cuestionarios->pluck('valor_resultado');

         return view('cuestionarios.estadistica', compact('encuesta', 'cuestionarios','promedio', 'resultado_cuestionario'));
    }

    public function listado(Request $request)
    {
        $encuesta= Encuesta::find($request->encuesta);
        $cuestionarios = DB::table('cuestionarios')
        ->join('users','users.id','=','cuestionarios.usuario_id')
        ->leftJoin('resultados','resultados.id','=','cuestionarios.resultado_id')
        ->select('cuestionarios.id','cuestionarios.created_at', 'cuestionarios.cliente', 'users.name as encuestador','cuestionarios.estado','resultados.resultado')
        ->where('cuestionarios.estado','=','1')
        ->orderBy('cuestionarios.id', 'desc')
        ->limit(15)
        ->get();
        $cuestionarios = $cuestionarios->reverse();
        return view('cuestionarios.listado', compact('encuesta', 'cuestionarios'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
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
        $respuestas = DB::table('respuestas')
        ->join('preguntas', 'preguntas.id','=','respuestas.pregunta_id')
        ->join('formatos_respuestas','formatos_respuestas.id','=','preguntas.formatos_respuesta_id')
        ->select('respuestas.id','preguntas.pregunta','preguntas.ponderacion', 'formatos_respuestas.id as formato_id', 'formatos_respuestas.formato','valor_id')
        ->where('respuestas.cuestionario_id','=',$cuestionario->id)
        ->get();

        // return  $respuestas;
        $valores = Valores_respuesta::all();

        return view('cuestionarios.show',compact('cuestionario','respuestas', 'valores'));

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
        $resultado_cuestionario_display ='';

        foreach ($resultados as $resultado) {
            if ($resultado->minimo <= $valor_resultado AND $resultado->maximo >= $valor_resultado) {
                $resultado_cuestionario = $resultado->id;
                $resultado_cuestionario_display = $resultado->resultado;
            }
        }

        $cliente = $request->cliente;
        $estado = $request->estado;

        if ($estado == 1) {

            $notificacion = new Notificacion;
            $notificacion->url = '/cuestionarios/'.$cuestionario->id;
            $notificacion->usuario_id = 1;
            $notificacion->cliente = $request->cliente;
            $notificacion->encuesta = $cuestionario->encuesta()->nombre;
            $notificacion->resultado = $resultado_cuestionario_display;
            $notificacion->encuestador = Auth::user()->name;
            $notificacion->leido = 0;
            $notificacion->save();
        }



        $cuestionario->cliente = $cliente;
        $cuestionario->valor_resultado = $valor_resultado;
        $cuestionario->estado = $estado;
        $cuestionario->resultado_id = $resultado_cuestionario;
        $cuestionario->update();

        $respuestas = $request->respuestas;
        foreach ($respuestas as $id => $value) {
            $respuesta = Respuesta::find($id);
            $respuesta->valor_id = $respuestas[$id][0];
            $respuesta->update();
        }

        return redirect()->route('cuestionarios.index');
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
