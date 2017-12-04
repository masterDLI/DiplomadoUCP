@extends('layout')

@section('contenido')

<div class="zona-formulario ancho-40 margen-auto borde s-100">
	<div class="form-titulo">
		<center><span>Nuevo Usuario</span></center>
	</div>
	<form action="{{ route('usuarios.store') }}" method="POST">
		{{ csrf_field() }}
		@include('usuarios.form')
	</form>
</div>

@stop