@extends('layout')

@section('contenido')

<div class="zona-formulario ancho-50 margen-auto borde s-100">
	<div class="form-titulo">
		<center><span>Editar Perfil</span></center>
	</div>
	<form action="{{ route('perfiles.update', $perfil->id) }}" method="POST">
		{{ csrf_field() }}
		<input name="_method" type="hidden" value="PUT">
		@include('perfiles.form')
	</form>
</div>

@stop