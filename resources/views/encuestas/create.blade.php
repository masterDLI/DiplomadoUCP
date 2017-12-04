@extends('layout')

@section('contenido')

<div class="zona-formulario ancho-40 margen-auto borde s-100">
	<div class="form-titulo">
		<center><span>Nueva Encuesta</span></center>
	</div>
	<form action="{{ route('encuestas.store') }}" method="POST">
		{{ csrf_field() }}
		@include('encuestas.form-campos')
		<div class="conjunto-grupo">
			<div class="form-grupo ">
				<div class="form-renglon flex">
					<div class="form-columna ancho-50">
						<a class="form-btn btn-cancelar" href="{{ route('encuestas.index') }}">CANCELAR</a>
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