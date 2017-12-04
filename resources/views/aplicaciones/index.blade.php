@extends('layout')

@section('contenido')

<div class="zona-tabla ancho-50 margen-auto borde s-100">
	<div class="tabla-titulo">
		<center><span>Lista Aplicaciones</span></center>
		<div class="nuevo-item">
			<a href="{{ route('aplicaciones.create') }}">
				<img class="iconos-dentro-de-tyf" src="/imagenes/iconos/icono-nuevo.svg" title="Nueva Aplicación">
			</a>
		</div>
	</div>
	@include('/mensaje_info')

	@php($col1='ancho-40')
	@php($col2='ancho-20')
	@php($col3='ancho-20')
	@php($col4='ancho-20')


	<table class="ancho-100 table-fixed">

		<thead>
			<tr>
				<td class="{{ $col1 }}">Aplicación</td>
				<td class="{{ $col2 }}">Url</td>
				<td class="{{ $col3 }}">Editar</td>
				<td class="{{ $col4 }}">Eliminar</td>
			</tr>
		</thead>
		<tbody class="alto-350-px">
			@foreach($aplicaciones as $aplicacion)
				<tr>
					<td class="{{ $col1 }}">{{ $aplicacion->aplicacion }}</td>
					<td class="{{ $col2 }} texto-centrar">{{ $aplicacion->url }}</td>
					<td class="{{ $col3 }} texto-centrar">
						<a class="es-link" href="{{ route('aplicaciones.edit', $aplicacion->id) }}">
							Editar
						</a>
					</td>
					<td class="{{ $col4}} texto-centrar">
						<form class="form_aplicacion_{{ $aplicacion->id }}" action="{{ route('aplicaciones.destroy', $aplicacion->id) }}" method="POST">
							{{ csrf_field() }}
  							<input  name="_method" type="hidden" value="DELETE">
							<input class="eliminar_aplicacion" data-id="{{ $aplicacion->id }}" type="submit" value="Eliminar">
						</form>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>

<script>
	$(".eliminar_aplicacion").click(function(e){
		e.preventDefault();
		id=$(this).attr('data-id');
		// alert(id);
		swal({
		  title: 'Seguro de eliminar la aplicación?',
		  text: "No podrás revertir esto!",
		  type: 'question',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Si, Eliminar',
		  cancelButtonText: 'Cancelar',
		}).then(function (result) {
		  $(".form_aplicacion_"+id).submit();
		});
	});
</script>

@stop