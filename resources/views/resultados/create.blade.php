@extends('layout')

@section('contenido')

<div class="zona-formulario ancho-40 margen-auto s-100">
	<div class="form-titulo">
		<center><span>Nueva Resultado - Encuesta <span style="color: red;"> {{ $encuesta->nombre }}</span></span></center>
	</div>
	<form action="{{ route('resultados.store', ['encuesta_id'=> $encuesta->id]) }}" method="POST">
		{{ csrf_field() }}
		@include('/mensaje_info')
		@include('resultados.form')
	</form>

</div>

@stop