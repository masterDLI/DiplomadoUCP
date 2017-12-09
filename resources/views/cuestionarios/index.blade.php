@extends('layout')

@section('contenido')

	<div class="zona-tabla ancho-50 margen-auto borde s-100">
		<div class="tabla-titulo">
			<center><span>Lista de Encuestas</span></center>
		</div>
		<table class="ancho-100">
			@php($col1='ancho-55')
			@php($col2='ancho-15')
			@php($col3='ancho-15')
			@php($col4='ancho-15')
			<thead>
				<tr>
					<td class="{{ $col1 }}">Nombre Encuesta</td>
					<td class="{{ $col2 }}">Cuestionarios</td>
					<td class="{{ $col3 }}" >Estadistica</td>
					<td class="{{ $col4 }}">Nuevo Cuestionario</td>
				</tr>
			</thead>
			<tbody>
				@foreach($encuestas as $encuesta)
					<tr>
						<td class="{{ $col1 }}">{{ $encuesta->nombre }}</td>
						<td class="{{ $col2 }} texto-centrar">
							<a href="{{ route('listado', ['encuesta'=>$encuesta->id]) }}">
								<svg class="icon-search">
									<use xlink:href="#icon-search"></use>
								</svg>
							</a></td>
						<td class="{{ $col3 }} texto-centrar">
							<a class="es-link" href="{{ route('estadistica', ['encuesta'=>$encuesta->id]) }}">
								<svg class="icon-line-chart">
									<use xlink:href="#icon-line-chart"></use>
								</svg>
							</a></td>
						<td class="{{ $col4 }} texto-centrar">
							<a href="{{ route('cuestionarios.create',['id'=>$encuesta->id]) }}">
								<svg class="icon-plus">
									<use xlink:href="#icon-plus"></use>
								</svg>
							</a>
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
<style>
	[class^="icon-"], [class*=" icon-"] {
    height: 15px;
    width: 15px;
    display: inline-block;
    fill: currentColor;
	}
</style>
@stop