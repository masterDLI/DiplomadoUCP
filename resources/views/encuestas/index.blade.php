@extends('layout')

@section('contenido')

	<div class="zona-tabla ancho-50 margen-auto borde s-100">
		<div class="tabla-titulo">
			<center><span>Lista de Encuestas</span></center>
			<div class="nuevo-item">
				<a href="{{ route('encuestas.create') }}">
					<img class="iconos-dentro-de-tyf" src="/imagenes/iconos/icono-nuevo.svg" title="Nueva Encuesta">
				</a>
			</div>
		</div>
		<table class="ancho-100">
			<colgroup>
				<col class="ancho-70">
				<col class="ancho-15">
				<col class="ancho-15">
			</colgroup>
			<thead>
				<tr>
					<td>Nombre Encuesta</td>
					<td>Editar</td>
					<td>Eliminar</td>
				</tr>
			</thead>
			<tbody>
				@foreach($encuestas as $encuesta)
					<tr>
						<td>{{ $encuesta->nombre }}</td>
						<td class="texto-centrar">
							<a class="es-link" href="{{ route('encuestas.edit', $encuesta->id) }}">
								Editar
							</a>
						</td>
						<td class="texto-centrar">

							<form class="form_encuesta_{{ $encuesta->id }}" action="{{ route('encuestas.destroy', $encuesta->id) }}" method="POST">
								{{ csrf_field() }}
      							<input  name="_method" type="hidden" value="DELETE">
								<input class="eliminar_encuesta" data-id="{{$encuesta->id}}" type="submit" value="Eliminar">
							</form>

						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>

<script>
	$(".eliminar_encuesta").click(function(e){
		e.preventDefault();
		id=$(this).attr('data-id');
		// alert(id);
		swal({
		  title: 'Seguro de eliminar la encuesta?',
		  text: "No podrás revertir esto!",
		  type: 'question',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Si, Eliminar',
		  cancelButtonText: 'Cancelar',
		}).then(function (result) {
		  $(".form_encuesta_"+id).submit();
		});
	});
</script>

@stop