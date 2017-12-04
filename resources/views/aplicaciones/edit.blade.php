@extends('layout')

@section('contenido')

<div class="zona-formulario ancho-40 margen-auto borde s-100">
	<div class="form-titulo">
		<center><span>Nueva Aplicación</span></center>
	</div>
	<form action="{{ route('aplicaciones.update', ['id'=> $aplicacion->id ]) }}" method="POST">
		<input name="_method" type="hidden" value="PUT">
		@include('aplicaciones.form')
	</form>
</div>

@stop