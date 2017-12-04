<div class="conjunto-grupo">
	<div class="form-grupo borde">
		<div class="form-renglon">
			<div class="form-columna">
				<label class="form-label" for="nombre">Usuario</label>
				<input class="form-input" name="nombre" type="text" value="{{ $usuario->name or old('nombre') }}">
				 <span class="form-error">{{ $errors->first('nombre') }}</span>
			</div>
		</div>
		<div class="form-renglon">
			<div class="form-columna">
				<label class="form-label" for="email">Email</label>
				<input class="form-input" name="email" type="email" value="{{ $usuario->email or old('email') }}">
				 <span class="form-error">{{ $errors->first('emial') }}</span>
			</div>
		</div>
		<div class="form-renglon">
			<div class="form-columna">
				<label class="form-label" for="perfil">Perfil</label>
						<select class="form-select" name="perfil">
							<option value=""></option>
							@foreach($perfiles as $perfil)

								@if (isset($usuario->perfil_id))
								     <option value="{{ $perfil->id }}"
								       {{ (collect(old('perfil'))->contains($perfil->id )) ? 'selected':'' }}
								       {{ ($usuario->perfil_id == $perfil->id) ? 'selected':'' }}>
								       {{ $perfil->perfil }}
								   </option>
								@else
								      <option value="{{ $perfil->id }}">{{ $perfil->perfil }}</option>
								@endif

							@endforeach
						</select>
				 <span class="form-error">{{ $errors->first('perfil') }}</span>
			</div>
		</div>
	</div>
</div>

@if(isset($usuario->id))
<div class="conjunto-grupo">
	<div class="form-grupo borde">
		<div class="form-renglon">
			<div class="form-columna flex">
				<a class="margen-auto es-link" style="padding: 5px; background: #F7C9C9;"  href="{{ route('resetpass', $usuario->id) }}">Blanquear Contraseña</a>
			</div>
		</div>
	</div>
</div>
@endif
@include('/mensaje_info')

<div class="conjunto-grupo">
	<div class="form-grupo ">
		<div class="form-renglon flex">
			<div class="form-columna ancho-50">
				<a class="form-btn btn-cancelar" href="{{ route('usuarios.index') }}">CANCELAR</a>
			</div>
			<div class="form-columna ancho-50 texto-derecha">
				<input class="form-btn btn-guardar" type="submit" value="{{ $btnText or 'GUARDAR' }}">
			</div>
		</div>
	</div>
</div>