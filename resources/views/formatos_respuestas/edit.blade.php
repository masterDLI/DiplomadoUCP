@extends('layout')

@section('contenido')

<div class="zona-formulario ancho-50 margen-auto borde s-100">
	<div class="form-titulo">
		<center><span>Editar Formato '{{ $formato->formato }}'</span></center>
	</div>
	<form action="{{ route('formatos_respuestas.update', ['formato' => $formato->id]) }}" method="POST">
		 <input name="_method" type="hidden" value="PUT">
		{{ csrf_field() }}

		@include('formatos_respuestas.form')

		@include('/mensaje_info')

		<div class="form-renglon">
			<div class="form-columna">
				<div class="zona-tabla ancho-100">
					<div class="tabla-titulo">
						<center><span>Valores Respuestas</span></center>
						<div class="nuevo-item">
							<a href="{{ route('valores.create', ['formato' => $formato->id]) }}">
								<img class="iconos-dentro-de-tyf" src="/imagenes/iconos/icono-nuevo.svg" title="Nuevo Formato">
							</a>
						</div>
					</div>
					@php($col1='ancho-50')
					@php($col2='ancho-20')
					@php($col3='ancho-15')
					@php($col4='ancho-15')

					<table class="ancho-100 table-fixed borde">
						<thead>
							<tr>
								<td class="{{ $col1 }}">Respuesta</td>
								<td class="{{ $col2 }}">Valor</td>
								<td class="{{ $col3 }}">Editar</td>
								<td class="{{ $col4 }}">Eliminar</td>
							</tr>
						</thead>
						<tbody class="alto-350-px">

							@foreach($valores as $valor)

								<tr>
									<td class="{{ $col1 }}">{{ $valor->respuesta }}</td>
									<td class="{{ $col2 }} texto-centrar">{{ $valor->valor }}</td>
									<td class="{{ $col3 }} texto-centrar ">
										<a class="es-link btn-editar" href="{{ route('valores.edit', $valor->id) }}">
											Editar
										</a>
									</td>
									<td class="{{ $col4 }} texto-centrar">
										</form>
										<form class="form_valor_{{ $valor->id }}"  action="{{ route('valores.destroy',['id'=>$valor->id]) }}" method="POST">
											{{ csrf_field() }}
			      							<input name="_method" type="hidden" value="DELETE">
											<input class="eliminar_valor es-link btn-eliminar" data-id="{{ $valor->id }}" type="submit" value="Eliminar">
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

<script>
	$(".eliminar_valor").click(function(e){
		e.preventDefault();
		id=$(this).attr('data-id');
		// alert(id);
		swal({
		  title: 'Seguro de eliminar el valor?',
		  text: "No podrás revertir esto!",
		  type: 'question',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Si, Eliminar',
		  cancelButtonText: 'Cancelar',
		}).then(function (result) {
		  $(".form_valor_"+id).submit();
		});
	});
</script>

@stop