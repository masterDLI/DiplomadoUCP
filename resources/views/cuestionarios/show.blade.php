@extends('layout')

@section('contenido')
@php($user = Auth::user())

<div class="zona-formulario ancho-70 margen-auto borde s-100">

	<div class="form-titulo">
		<center><span>Cuestionario - Encuesta '{{ $cuestionario->encuesta()->nombre }}'</span></center>
	</div>
		<div class="conjunto-grupo ">
			<div class="form-grupo borde">
				<div class="form-renglon flex flex-justificar">
					<div class="form-columna ancho-1-3">
						<label class="form-label" for="">Fecha Alta</label>
						<input class="form-input ancho-100" name="fecha" type="text" value="{{ $cuestionario->created_at or old('fecha') }}" readonly="true">
						<span class="form-error">{{ $errors->first('fecha') }}</span>
					</div>
					<div class="form-columna ancho-1-3">
						<label class="form-label" for="">Encuestador</label>
						<input class="form-input ancho-100" name="encuestador" type="text" value="{{ $user->name or old('encuestador') }}" readonly="true" readonly="true">
						<span class="form-error">{{ $errors->first('encuestador') }}</span>
					</div>
				</div>

				<div class="form-renglon flex flex-justificar">
					<div class="form-columna ancho-2-3">
						<label class="form-label" for="">Cliente</label>
						<input class="form-input ancho-100" name="cliente" type="text" value="{{ $cuestionario->cliente or old('cliente') }}" readonly="true">
						<span class="form-error">{{ $errors->first('cliente') }}</span>
					</div>
					<div class="form-columna ancho-1-3">
						<label class="form-label" for="">Estado</label>
						<select class="form-select select-estado" name="estado" id="" readonly="true">
							<option value="0" {{ ($cuestionario->estado == 0) ? 'selected' : ''}} disabled="true">Pendiente</option>
							<option value="1" {{ ($cuestionario->estado == 1) ? 'selected' : '' }} disabled="true">Terminado</option>
						</select>
					</div>
				</div>
			</div>
		</div>

		<div class="conjunto-grupo ">
			<div class="form-grupo">
				<div class="form-renglon flex flex-justificar">

					<div class="zona-tabla ancho-100 margen-auto">
						@php($col1='ancho-60')
						@php($col2='ancho-15')
						@php($col3='ancho-25')

						<table class="ancho-100 table-fixed ">
							<thead>
								<tr>
									<td class="{{ $col1 }}">Pregunta</td>
									<td class="{{ $col2 }}">Formato</td>
									<td class="{{ $col3 }}">Respuesta</td>
								</tr>
							</thead>
							<tbody class="alto-350-px">
								@foreach($respuestas as $respuesta)
									<tr>
										<td class="{{ $col1 }}">{{ $respuesta->pregunta }}</td>
										<td class="{{ $col2 }}">{{ $respuesta->formato }}</td>
										<td class="{{ $col3 }} texto-centrar">
											<select class="form-select form-respuesta ancho-80" data-ponderacion="{{ $respuesta->ponderacion }}" name="respuestas[{{ $respuesta->id }}][]">
												<option value="0" disabled="true"></option>
												@foreach($valores as $valor)
													@if($respuesta->formato_id == $valor->formatos_respuesta_id)
														<option value="{{ $valor->id }}" data-valor="{{ $valor->valor }}"
																{{ ($valor->id == $respuesta->valor_id) ? 'selected' : '' }} disabled="true">
															{{ $valor->respuesta }}
														</option>
													@endif
												@endforeach
											</select>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

	<input type="hidden" id="resultado" name="resultado" value="">

		<div class="conjunto-grupo">
			<div class="form-grupo ">
				<div class="form-renglon flex">
					<div class="form-columna ancho-50">
						{{-- <a   href="{{ route('cuestionarios.index') }}">CANCELAR</a> --}}
						<input class="form-btn btn-cancelar" onclick="history.back()" type="text" value="Volver">
					</div>
				</div>
			</div>
		</div>

	</form>
</div>

<script>
	// $(".form-select").change(function(){
	// 	var ponderacion = $(this).data('ponderacion');
	// 	var valor = $(this).find('option:selected').data('valor');
	// 	alert(seleccionado);
	// })

	// select=$('.form-select');

	// alert(select);
	$(document).ready(function(){

		function calcular(){

			var puntaje_parcial = 0;
			var puntaje_total = 0;

			 $(".formCuestionario").find('.form-respuesta').each(function() {
			 	var ponderacion = $(this).data('ponderacion');
			 	var valor = $(this).find('option:selected').data('valor');
			 	puntaje_parcial = valor * ponderacion / 100;
			 	puntaje_total= puntaje_total + puntaje_parcial;
		       });

			 $('#resultado').val(puntaje_total);
		}

		calcular();

		$(".form-select").change(function(){
			calcular();
		})


		$(".btn-guardar").click(function(e){
			e.preventDefault();

			if ($('.select-estado').val()==0) {
				swal({
				  title: 'Estado de Cuestionario?',
				  text: "Confirma el el cuestionario en estado PENDIENTE!",
				  type: 'question',
				  showCancelButton: true,
				  confirmButtonColor: '#3085d6',
				  cancelButtonColor: '#d33',
				  confirmButtonText: 'Si, Enviar',
				  cancelButtonText: 'Cancelar',
				}).then(function (result) {
					  $(".formCuestionario").submit();
				});
			}else{
				$(".formCuestionario").submit();
			}
		});









	});







</script>



@stop
