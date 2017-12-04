@extends('layout')

@section('contenido')

	<div class="zona-formulario ancho-50 margen-auto">
		<div class="form-titulo">
			<center><span>Editar Valor Respuesta - <span style="color:red;">{{ $valor->respuesta }}</span></span></center>
		</div>
		<form action="{{ route('valores.update', ['valor'=>$valor->id]) }}" method="POST">
			{{ csrf_field() }}
			<input name="_method" type="hidden" value="PUT">
			@include('valores_respuestas.form')

			<div class="conjunto-grupo">
				<div class="form-grupo ">
					<div class="form-renglon flex">
						<div class="form-columna ancho-50">
							<a class="form-btn btn-cancelar" href="{{ route('formatos_respuestas.edit', $valor->formatos_respuesta_id) }}">CANCELAR</a>
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