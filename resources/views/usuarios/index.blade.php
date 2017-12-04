@extends('layout')

@section('contenido')

<div class="zona-tabla ancho-50 margen-auto borde s-100">
	<div class="tabla-titulo">
		<center><span>Lista Usuarios</span></center>
		<div class="nuevo-item">
			<a href="{{ route('usuarios.create') }}">
				<img class="iconos-dentro-de-tyf" src="/imagenes/iconos/icono-nuevo.svg" title="Nuevo Usuario">
			</a>
		</div>
	</div>
	@include('/mensaje_info')

	@php($col1='ancho-20')
	@php($col2='ancho-30')
	@php($col3='ancho-20')
	@php($col4='ancho-15')
	@php($col5='ancho-15')


	<table class="ancho-100 table-fixed">

		<thead>
			<tr>
				<td class="{{ $col1 }}">Usuario</td>
				<td class="{{ $col2 }}">Email</td>
				<td class="{{ $col3 }}">Perfil</td>
				<td class="{{ $col4 }}">Editar</td>
				<td class="{{ $col5 }}">Eliminar</td>
			</tr>
		</thead>
		<tbody class="alto-350-px">
			@foreach($usuarios as $usuario)
				<tr>
					<td class="{{ $col1 }}">{{ $usuario->name }}</td>
					<td class="{{ $col2 }}">{{ $usuario->email }}</td>
					<td class="{{ $col3}} texto-centrar">{{ $usuario->perfil()->perfil }}</td>
					<td class="{{ $col4 }} texto-centrar">
						<a class="es-link" href="{{ route('usuarios.edit', $usuario->id) }}">
							Editar
						</a>
					</td>
					<td class="{{ $col5 }} texto-centrar">
						<form class="form_perfil_{{ $usuario->id }}" action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST">
							{{ csrf_field() }}
  							<input  name="_method" type="hidden" value="DELETE">
							<input class="eliminar_perfil" data-id="{{ $usuario->id }}" type="submit" value="Eliminar">
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
