@extends('layout')

@section('contenido')

<div class="zona-tabla ancho-50 margen-auto borde s-100">
	<div class="tabla-titulo">
		<center><span>Lista Formatos Respuestas</span></center>
		<div class="nuevo-item">
			<a href="{{ route('formatos_respuestas.create') }}">
				<img class="iconos-dentro-de-tyf" src="/imagenes/iconos/icono-nuevo.svg" title="Nuevo Formato">
			</a>
		</div>
	</div>
	@include('/mensaje_info')
	<table class="ancho-100">
		<colgroup>
			<col class="ancho-70">
			<col class="ancho-15">
			<col class="ancho-15">
		</colgroup>
		<thead>
			<tr>
				<td>Formato</td>
				<td>Editar</td>
				<td>Eliminar</td>
			</tr>
		</thead>
		<tbody>
			@foreach($formatos as $formato)
				<tr>
					<td>{{ $formato->formato }}</td>
					<td class="texto-centrar">
						<a class="es-link" href="{{ route('formatos_respuestas.edit', $formato->id) }}">
							Editar
						</a>
					</td>
					<td class="texto-centrar">
						<form class="form_formato_{{ $formato->id }}" action="{{ route('formatos_respuestas.destroy', $formato->id) }}" method="POST">
							{{ csrf_field() }}
  							<input  name="_method" type="hidden" value="DELETE">
							<input class="eliminar_formato" data-id="{{$formato->id}}" type="submit" value="Eliminar">
						</form>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>

<script>
	$(".eliminar_formato").click(function(e){
		e.preventDefault();
		id=$(this).attr('data-id');
		// alert(id);
		swal({
		  title: 'Seguro de eliminar el formato?',
		  text: "No podrás revertir esto!",
		  type: 'question',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Si, Eliminar',
		  cancelButtonText: 'Cancelar',
		}).then(function (result) {
		  $(".form_formato_"+id).submit();
		});
	});
</script>

@stop