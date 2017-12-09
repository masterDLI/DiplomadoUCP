@extends('layout')

@section('contenido')

<div class="conjunto-grupo ancho-100 ">
	<div class="form-grupo">
		<div class="form-renglon ancho-100">
			<div class="form-columna ancho-50 margen-auto">
				<div class="zona-tabla ancho-100 margen-auto borde s-100" >
					<div class="form-titulo">
						<center><span>Gráfica Cuestionarios - Encuesta '{{ $encuesta->nombre }}'</span></center>
					</div>

					<table class="ancho-100 table-fixed">
						@php($col1='ancho-15')
						@php($col2='ancho-25')
						@php($col3='ancho-25')
						@php($col4='ancho-10')
						@php($col5='ancho-15')
						@php($col6='ancho-10')
						<thead>
							<tr>
								<td class="{{ $col1 }}">Fecha</td>
								<td class="{{ $col2 }}">Cliente</td>
								<td class="{{ $col3 }}" >Encuestador</td>
								<td class="{{ $col4 }}">Valor</td>
								<td class="{{ $col5 }}">Resultado</td>
								<td class="{{ $col6 }}">Ver</td>
							</tr>
						</thead>
						<tbody class="alto-250-px">
							@foreach($cuestionarios as $cuestionario)
								<tr>
									<td class="{{ $col1 }} texto-centrar">{{ date('d-m-Y', strtotime($cuestionario->created_at)) }}</td>
									<td class="{{ $col2 }}">{{ $cuestionario->cliente }}</td>
									<td class="{{ $col3 }} texto-centrar">{{ $cuestionario->encuestador }}</td>
									<td class="{{ $col4 }} texto-centrar">{{ $cuestionario->valor_resultado }}</td>
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
						<tfoot>
							<tr style="background: #F0EAEA">
								<td class="ancho-65 texto-centrar">Indice Gral</td>
								<td class="ancho-10 texto-centrar">{{ $promedio }}</td>
								<td class="ancho-25 texto-centrar">{{ $resultado_cuestionario }}</td>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
			<div class="form-columna ancho-50 alto-450-px margen-auto">
				<div class="zona-tabla ancho-100 margen-auto borde s-100">
					<div id="container" class="alto-350-px"></div>
				</div>
			</div>
		</div>
	</div>
</div>

</div>
<style>
	[class^="icon-"], [class*=" icon-"] {
    height: 15px;
    width: 15px;
    display: inline-block;
    fill: currentColor;
	}
</style>

<script>


Highcharts.chart('container', {

    title: {
        text: 'Gráfica Evolución'
    },

    subtitle: {
        text: ''
    },
    xAxis: {
        categories: [
        	@foreach ($cuestionarios as $cuestionario)
        		'{{ $cuestionario->resultado }}',
        	@endforeach
        ]
    },

    yAxis: {
        title: {
            text: 'Puntaje'
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'middle'
    },

    plotOptions: {
        line: {
            dataLabels: {
                enabled: true
            },
            enableMouseTracking: false
        }
    },

    series: [{
        name: '{{ $encuesta->nombre }}',
        data: [{{ $cuestionarios->pluck('valor_resultado')->implode(', ') }}]
    }],

    responsive: {
        rules: [{
            condition: {
                maxWidth: 500,
                maxHight: 200
            },
            chartOptions: {
                legend: {
                    layout: 'horizontal',
                    align: 'center',
                    verticalAlign: 'bottom'
                }
            }
        }]
    }

});
</script>
@stop