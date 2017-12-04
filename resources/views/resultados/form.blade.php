<div class="conjunto-grupo ">
	<div class="form-grupo borde">
		<div class="form-renglon flex flex-justificar">
			<div class="form-columna ancho-1-3">
				<label class="form-label" for="">Mínimo</label>
				<input class="form-input ancho-40" name="mínimo" type="text" value="{{ $resultado->minimo or old('mínimo') }}">
				<span class="form-error">{{ $errors->first('mínimo') }}</span>
			</div>
			<div class="form-columna ancho-1-3">
				<label class="form-label" for="">Máximo</label>
				<input class="form-input ancho-40" name="máximo" type="text" value="{{ $resultado->maximo or old('máximo') }}">
				<span class="form-error">{{ $errors->first('máximo') }}</span>
			</div>
			<div class="form-columna ancho-1-3">
				<label class="form-label" for="">Resultado</label>
				<input class="form-input" type="text" name="resultado" value="{{ $resultado->resultado or old('resultado')}}">
				<span class="form-error">{{ $errors->first('resultado') }}</span>
			</div>
		</div>
	</div>
</div>
<div class="conjunto-grupo">
	<div class="form-grupo ">
		<div class="form-renglon flex">
			<div class="form-columna ancho-50">
				<a class="form-btn btn-cancelar" href="{{ route('resultados.index', ['id' => $encuesta->id]) }}">CANCELAR</a>
			</div>
			<div class="form-columna ancho-50 texto-derecha">
				<input class="form-btn btn-guardar" type="submit" value="GUARDAR">
			</div>
		</div>
	</div>
</div>