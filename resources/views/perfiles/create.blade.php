@extends('layout')

@section('contenido')

<div class="zona-formulario ancho-50 margen-auto borde s-100">
	<div class="form-titulo">
		<center><span>Nuevo Perfil</span></center>
	</div>
	<form action="{{ route('perfiles.store') }}" method="POST">
		{{ csrf_field() }}

		@include('perfiles.form')

	</form>
</div>

@stop