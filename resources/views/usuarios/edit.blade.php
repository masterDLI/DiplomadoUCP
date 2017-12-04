@extends('layout')

@section('contenido')

<div class="zona-formulario ancho-40 margen-auto borde s-100">
	<div class="form-titulo">
		<center><span>Editar Usuario</span></center>
	</div>
	<form action="{{ route('usuarios.update', $usuario->id) }}" method="POST">
		{{ csrf_field() }}
		<input name="_method" type="hidden" value="PUT">
		@include('usuarios.form', ['btnText'=>'ACTUALIZAR'])
	</form>
</div>

@stop