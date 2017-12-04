{{ csrf_field() }}

<div class="conjunto-grupo">
	<div class="form-grupo borde">
		<div class="form-renglon">
			<div class="form-columna">
				<label class="form-label" for="aplicación">Aplicación</label>
				<input class="form-input" name="aplicación" type="text" value="{{ $aplicacion->aplicacion or old('aplicación') }}">
				 <span class="form-error">{{ $errors->first('aplicación') }}</span>
			</div>
		</div>

		<div class="form-renglon">
			<div class="form-columna">
				<label class="form-label" for="url">URL</label>
				<input class="form-input" name="url" type="text" value="{{ $aplicacion->url or old('url') }}">
				 <span class="form-error">{{ $errors->first('url') }}</span>
			</div>
		</div>
	</div>
</div>
<div class="conjunto-grupo">
	<div class="form-grupo borde">

	</div>
</div>



<div class="conjunto-grupo">
	<div class="form-grupo ">
		<div class="form-renglon flex">
			<div class="form-columna ancho-50">
				<a class="form-btn btn-cancelar" href="{{ route('aplicaciones.index') }}">CANCELAR</a>
			</div>
			<div class="form-columna ancho-50 texto-derecha">
				<input class="form-btn btn-guardar" type="submit" value="GUARDAR">
			</div>
		</div>
	</div>
</div>