		{{ csrf_field() }}

		<input type="hidden" name="encuesta_id" value="{{ $encuesta->id }}">

		<div class="conjunto-grupo">
			<div class="form-grupo">
				<div class="form-renglon">
					<div class="form-columna">
						<label class="form-label" for="pregunta">Pregunta</label>
						<input class="form-input" name="pregunta" type="text" value="{{ $pregunta->pregunta or old('pregunta') }}">
						 <span class="form-error">{{ $errors->first('pregunta') }}</span>
					</div>
				</div>
			</div>
		</div>

		<div class="conjunto-grupo">
			<div class="form-grupo">
				<div class="form-renglon flex flex-justificar">
					<div class="form-columna ancho-50">
						<label class="form-label" for="formato">Formato</label>
						<select class="form-select" name="formato">
							<option value=""></option>
							@foreach($formatos as $formato)

								@if (isset($pregunta->formatos_respuesta_id))
								     <option value="{{ $formato->id }}"
								       {{ (collect(old('formato'))->contains($formato->id )) ? 'selected':'' }}
								       {{ ($pregunta->formatos_respuesta_id == $formato->id) ? 'selected':'' }}>
								       	{{ $formato->formato }}
								   </option>
								@else
								      <option value="{{ $formato->id }}">{{ $formato->formato }}</option>
								@endif

							@endforeach
						</select>
						<span class="form-error">{{ $errors->first('formato') }}</span>
					</div>
					<div class="form-columna ancho-50">
						<label class="form-label" for="ponderación">Ponderación</label>
						<input class="form-input" name="ponderación" type="text" value="{{ $pregunta->ponderacion or old('ponderación') }}">
						<span class="form-error">{{ $errors->first('ponderación') }}</span>
					</div>
				</div>
			</div>
		</div>

		<div class="conjunto-grupo">
			<div class="form-grupo ">
				<div class="form-renglon flex">
					<div class="form-columna ancho-50">
						<a class="form-btn btn-cancelar" href="{{ route('encuestas.edit', ['id' => $encuesta->id]) }}">CANCELAR</a>
					</div>
					<div class="form-columna ancho-50 texto-derecha">
						<input class="form-btn btn-guardar" type="submit" value="GUARDAR">
					</div>
				</div>
			</div>
		</div>