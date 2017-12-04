@extends('layout')

@section('contenido')

<div class="zona-tabla ancho-50 margen-auto borde s-100">
	<div class="tabla-titulo">
		<center><span>Lista Pefiles</span></center>
		<div class="nuevo-item">
			<a href="{{ route('perfiles.create') }}">
				<img class="iconos-dentro-de-tyf" src="/imagenes/iconos/icono-nuevo.svg" title="Nuevo Perfil">
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
				<td>Perfil</td>
				<td>Editar</td>
				<td>Eliminar</td>
			</tr>
		</thead>
		<tbody>
			@foreach($perfiles as $perfil)
				<tr>
					<td>{{ $perfil->perfil }}</td>
					<td class="texto-centrar">
						<a class="es-link" href="{{ route('perfiles.edit', $perfil->id) }}">
							Editar
						</a>
					</td>
					<td class="texto-centrar">
						<form class="form_perfil_{{ $perfil->id }}" action="{{ route('perfiles.destroy', $perfil) }}" method="POST">
							{{ csrf_field() }}
  							<input  name="_method" type="hidden" value="DELETE">
							<input class="eliminar_perfil" data-id="{{$perfil->id}}" type="submit" value="Eliminar">
						</form>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>

<script>
	$(".eliminar_perfil").click(function(e){
		e.preventDefault();
		id=$(this).attr('data-id');
		// alert(id);
		swal({
		  title: 'Seguro de eliminar el Perfil?',
		  text: "No podrás revertir esto!",
		  type: 'question',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Si, Eliminar',
		  cancelButtonText: 'Cancelar',
		}).then(function (result) {
		  $(".form_perfil_"+id).submit();
		});
	});
</script>

@stop