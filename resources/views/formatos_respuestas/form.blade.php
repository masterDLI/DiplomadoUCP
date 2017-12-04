<div class="conjunto-grupo">
	<div class="form-grupo borde">
		<div class="form-renglon">
			<div class="form-columna">
				<label class="form-label" for="formato">Formato</label>
				<input class="form-input" name="formato" type="text" value="{{ $formato->formato or old('formato') }}">
				 <span class="form-error">{{ $errors->first('formato') }}</span>
			</div>
		</div>
	</div>
</div>