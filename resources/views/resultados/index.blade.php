@extends('layout')

@section('contenido')

<div class="zona-tabla ancho-50 margen-auto">
	<div class="tabla-titulo">
		<center><span>Resultados de Encuesta <span style="color: red;">'{{ $encuesta->nombre }}'</span></span></center>
		<div class="nuevo-item">
			<a href="{{ route('resultados.create', ['encuesta' => $encuesta->nombre]) }}">
				<img class="iconos-dentro-de-tyf" src="/imagenes/iconos/icono-nuevo.svg" title="Nuevo Resultado">
			</a>
		</div>
	</div>
	@php($col1='ancho-20')
	@php($col2='ancho-20')
	@php($col3='ancho-20')
	@php($col4='ancho-20')
	@php($col5='ancho-20')
	<table class="ancho-100 table-fixed borde">
		<thead>
			<tr>
				<td class="{{ $col1 }}">Mínimo</td>
				<td class="{{ $col2 }}">Máximo</td>
				<td class="{{ $col3 }}">Resutado</td>
				<td class="{{ $col4 }}">Editar</td>
				<td class="{{ $col5 }}">Eliminar</td>
			</tr>
		</thead>
		<tbody class="alto-200-px">

			@php ($nro = 0)

			@foreach($resultados as $resultado)
			@php ($nro = $nro + 1)

				<tr>
					<td class="{{ $col1 }} texto-centrar">{{ $resultado->minimo }}</td>
					<td class="{{ $col2 }} texto-centrar">{{ $resultado->maximo }}</td>
					<td class="{{ $col3 }} texto-centrar">{{ $resultado->resultado }}</td>
					<td class="{{ $col4 }} texto-centrar ">
						<a class="es-link btn-editar" href="{{ route('resultados.edit', $resultado->id) }}">
							Editar
						</a>
					</td>
					<td class="{{ $col4 }} texto-centrar">
						</form>
						<form class="form_resultado_{{ $resultado->id }}"  action="{{ route('resultados.destroy', $resultado->id) }}" method="POST">
							{{ csrf_field() }}
  							<input name="_method" type="hidden" value="DELETE">
							<input class="eliminar_resultado es-link btn-eliminar" data-id="{{ $resultado->id }}" type="submit" value="Eliminar">
						</form>

					</td>
				</tr>
			@endforeach
		</tbody>
	</table>

	<div class="conjunto-grupo">
		<div class="form-grupo ">
			<div class="form-renglon flex">
				<div class="form-columna ancho-50">
					<a class="form-btn btn-cancelar" href="{{ route('encuestas.edit', ['id' => $encuesta->id]) }}">Volver a Encuesta {{ $encuesta->nombre }}</a>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$(".eliminar_resultado").click(function(e){
		e.preventDefault();
		id=$(this).attr('data-id');
		// alert(id);
		swal({
		  title: 'Seguro de eliminar el resultado?',
		  text: "No podrás revertir esto!",
		  type: 'question',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Si, Eliminar',
		  cancelButtonText: 'Cancelar',
		}).then(function (result) {
		  $(".form_resultado_"+id).submit();
		});
	});
</script>

@stop