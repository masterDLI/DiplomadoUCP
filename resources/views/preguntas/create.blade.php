@extends('layout')

@section('contenido')

<div class="zona-formulario ancho-40 margen-auto borde s-100">
	<div class="form-titulo">
		<center><span>Nueva Pregunta de encuesta "{{ $encuesta->nombre }}" </span></center>
	</div>
	<form action="{{ route('preguntas.store') }}" method="POST">
		@include('preguntas.form')
	</form>

</div>

@stop