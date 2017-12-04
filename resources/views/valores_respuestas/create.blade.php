@extends('layout')

@section('contenido')

	<div class="zona-formulario ancho-50 margen-auto">
		<div class="form-titulo">
			<center><span>Nuevo Valor Respuesta - Formato <span style="color:red;">{{ $formato->formato }}</span></span></center>
		</div>
		<form action="{{ route('valores.store', ['formato'=>$formato->id]) }}" method="POST">
			{{ csrf_field() }}

			@include('valores_respuestas.form')

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