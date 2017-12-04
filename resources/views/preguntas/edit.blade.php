@extends('layout')

@section('contenido')

<div class="zona-formulario ancho-40 margen-auto borde s-100">
	<div class="form-titulo">
		<center><span>Nueva Encuesta</span></center>
	</div>
	<form action="{{ route('preguntas.update', ['id'=> $pregunta->id ]) }}" method="POST">
		<input name="_method" type="hidden" value="PUT">
		@include('preguntas.form')
	</form>
</div>

@stop