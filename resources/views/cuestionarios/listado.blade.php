@extends('layout')

@section('contenido')

	<div class="zona-tabla ancho-70 margen-auto borde s-100">
		<div class="tabla-titulo">
			<center><span>Listado Encuestas de {{ $encuesta->nombre }}</span></center>
		</div>
		<table class="ancho-100">
			@php($col1='ancho-10')
			@php($col2='ancho-20')
			@php($col3='ancho-20')
			@php($col4='ancho-10')
			@php($col5='ancho-10')
			@php($col6='ancho-10')
			<thead>
				<tr>
					<td class="{{ $col1 }}">Fecha</td>
					<td class="{{ $col2 }}">Cliente</td>
					<td class="{{ $col3 }}" >Encuestador</td>
					<td class="{{ $col4 }}">Estado</td>
					<td class="{{ $col5 }}">Resultado</td>
					<td class="{{ $col6 }}">Ver</td>
				</tr>
			</thead>
			<tbody>
				@foreach($cuestionarios as $cuestionario)
					<tr>
						<td class="{{ $col1 }} texto-centrar">{{ date('d-m-Y', strtotime($cuestionario->created_at)) }}</td>
						<td class="{{ $col2 }}">{{ $cuestionario->cliente }}</td>
						<td class="{{ $col3 }} texto-centrar">{{ $cuestionario->encuestador }}</td>
						<td class="{{ $col4 }} texto-centrar">{{ ($cuestionario->estado == 1) ? 'Terminado' : 'Pendiente' }}</td>
						<td class="{{ $col5 }} texto-centrar">{{ $cuestionario->resultado }}</td>
						<td class="{{ $col6 }} texto-centrar">
							<a href="{{ route('cuestionarios.show', ['id'=>$cuestionario->id])  }}">
								<svg class="icon-search">
									<use xlink:href="#icon-search"></use>
								</svg>
							</a>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>

<style>
	[class^="icon-"], [class*=" icon-"] {
    height: 15px;
    width: 15px;
    display: inline-block;
    fill: currentColor;
	}
</style>
@stop