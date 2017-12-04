@extends('layout')

@section('contenido')

<div class="zona-formulario ancho-50 margen-auto borde s-100">
	<div class="form-titulo">
		<center><span>Nuevo Formato Respuesta</span></center>
	</div>
	<form action="{{ route('formatos_respuestas.store') }}" method="POST">
		{{ csrf_field() }}

		@include('formatos_respuestas.form')

		<div class="conjunto-grupo">
			<div class="form-grupo ">
				<div class="form-renglon flex">
					<div class="form-columna ancho-50">
						<a class="form-btn btn-cancelar" href="{{ route('formatos_respuestas.index') }}">CANCELAR</a>
					</div>
					<div class="form-columna ancho-50 texto-derecha">
						<input class="form-btn btn-guardar" type="submit" value="GUARDAR">
					</div>
				</div>
			</div>
		</div>

	</form>


</div>

@stop