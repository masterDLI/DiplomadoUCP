<div class="conjunto-grupo">
	<div class="form-grupo borde">
		<div class="form-renglon flex">
			<div class="form-columna ancho-70">
				<label class="form-label" for="respuesta">Respuesta</label>
				<input class="form-input" name="respuesta" type="text" value="{{ $valor->respuesta or old('respuesta') }}">
				 <span class="form-error">{{ $errors->first('respuesta') }}</span>
			</div>
			<div class="form-columna ancho-30">
				<label class="form-label" for="valor">Valor</label>
				<input class="form-input" name="valor" type="text" value="{{ $valor->valor or old('valor') }}">
				 <span class="form-error">{{ $errors->first('valor') }}</span>
			</div>
		</div>
	</div>
</div>