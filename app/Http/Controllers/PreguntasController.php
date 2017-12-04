<?php

namespace App\Http\Controllers;

use App\Encuesta;
use App\Formatos_respuesta;
use App\Pregunta;
use Illuminate\Http\Request;

class PreguntasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $encuesta_id = $request->encuesta;

        $encuesta = Encuesta::find($encuesta_id);
        $formatos = Formatos_respuesta::all();

        return view('preguntas.create', ['encuesta'=>$encuesta, 'formatos'=>$formatos]);

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
            'pregunta' => 'required',
            'formato' => 'required|numeric',
            'ponderación' => 'required|numeric'
        ]);

        $pregunta = new Pregunta();
        $pregunta->encuesta_id = $request->input('encuesta_id');
        $pregunta->pregunta = $request->input('pregunta');
        $pregunta->formatos_respuesta_id = $request->input('formato');
        $pregunta->ponderacion = $request->input('ponderación');
        $pregunta->save();

        return redirect()->route('encuestas.edit',['id'=>$request->encuesta_id])->with('info','Se guardó correctamente');


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

        $pregunta= Pregunta::find($id);
        $encuesta = $pregunta->encuesta();
        $formatos = Formatos_respuesta::all();

        return view('preguntas.edit', [
                    'pregunta'=> $pregunta,
                    'encuesta' => $encuesta,
                    'formatos' => $formatos,
                    'edit' => 1
                    ]);

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
        $this->validate($request, [
            'pregunta' => 'required',
            'formato' => 'required|numeric',
            'ponderación' => 'required|numeric'
        ]);

        $encuesta_id = $request->input('encuesta_id');

        $pregunta = Pregunta::find($id);
        $pregunta->pregunta = $request->input('pregunta');
        $pregunta->formatos_respuesta_id = $request->input('formato');
        $pregunta->ponderacion = $request->input('ponderación');
        $pregunta->update();

        return redirect()->route('encuestas.edit', ['id' => $encuesta_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pregunta = Pregunta::find($id);
        $encuesta_id=$pregunta->encuesta()->id;
        $pregunta->delete();
        return redirect()->route('encuestas.edit', ['id' => $encuesta_id]);
    }
}
