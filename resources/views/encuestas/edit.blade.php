@extends('layout')

@section('contenido')

<div class="zona-formulario ancho-50 margen-auto borde s-100">
	<div class="form-titulo">
		<center><span>Editar Encuesta '{{ $encuesta->nombre }}'</span></center>
	</div>
	<form action="{{ route('encuestas.update', ['encuesta' => $encuesta->id]) }}" method="POST">
		 <input name="_method" type="hidden" value="PUT">
		{{ csrf_field() }}

		@include('encuestas.form-campos')

		@include('/mensaje_info')

		<div class="form-renglon">
			<div class="form-columna">
				<div class="zona-tabla ancho-100">
					<div class="tabla-titulo">
						<center><span>Preguntas</span></center>
						<div class="nuevo-item">
							<a href="{{ route('preguntas.create', ['encuesta' => $encuesta->id]) }}">
								<img class="iconos-dentro-de-tyf" src="/imagenes/iconos/icono-nuevo.svg" title="Nueva Encuesta">
							</a>
						</div>
					</div>
					@php($col1='ancho-5')
					@php($col2='ancho-50')
					@php($col3='ancho-15')
					@php($col4='ancho-10')
					@php($col5='ancho-10')
					@php($col6='ancho-10')
					<table class="ancho-100 table-fixed borde">
						<thead>
							<tr>
								<td class="{{ $col1 }}">Nro</td>
								<td class="{{ $col2 }}">Preguntas</td>
								<td class="{{ $col3 }}">Formato</td>
								<td class="{{ $col4 }}">Pond.</td>
								<td class="{{ $col5 }}">Editar</td>
								<td class="{{ $col6 }}">Eliminar</td>
							</tr>
						</thead>
						<tbody class="alto-350-px">

							@php ($nro = 0)

							@foreach($encuesta->preguntas() as $pregunta)
							@php ($nro = $nro + 1)

								<tr>
									<td class="{{ $col1 }} texto-centrar">{{ $nro }}</td>
									<td class="{{ $col2 }}">{{ $pregunta->pregunta }}</td>
									<td class="{{ $col3 }} texto-centrar"> {{	$formatos[ $pregunta->formatos_respuesta_id ] }}</td>
									<td class="{{ $col4 }} texto-centrar">{{ $pregunta->ponderacion }}</td>
									<td class="{{ $col5 }} texto-centrar ">
										<a class="es-link btn-editar" href="{{ route('preguntas.edit', $pregunta->id) }}">
											Editar
										</a>
									</td>
									<td class="{{ $col6 }} texto-centrar">
										</form>
										<form class="form_pregunta_{{ $pregunta->id }}"  action="{{ route('preguntas.destroy', $pregunta->id) }}" method="POST">
											{{ csrf_field() }}
			      							<input name="_method" type="hidden" value="DELETE">
											<input class="eliminar_pregunta es-link btn-eliminar" data-id="{{ $pregunta->id }}" type="submit" value="Eliminar">
										</form>

									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
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

<script>
	$(".eliminar_pregunta").click(function(e){
		e.preventDefault();
		id=$(this).attr('data-id');
		// alert(id);
		swal({
		  title: 'Seguro de eliminar la Pregunta?',
		  text: "No podrás revertir esto!",
		  type: 'question',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Si, Eliminar',
		  cancelButtonText: 'Cancelar',
		}).then(function (result) {
		  $(".form_pregunta_"+id).submit();
		});
	});
</script>

@stop

