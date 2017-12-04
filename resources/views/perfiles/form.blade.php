<div class="conjunto-grupo">
	<div class="form-grupo borde">
		<div class="form-renglon">
			<div class="form-columna">
				<label class="form-label" for="perfil">Perfil</label>
				<input class="form-input" name="perfil" type="text" value="{{ $perfil->perfil or old('perfil') }}">
				 <span class="form-error">{{ $errors->first('perfil') }}</span>
			</div>
		</div>
	</div>
</div>

<div class="conjunto-grupo">
	<div class="form-grupo borde">
		<div class="form-renglon">
			<div class="form-columna">
				<div class="zona-tabla ancho-100">
					<div class="tabla-titulo">
						<center><span>Aplicaciones Disponibles</span></center>
					</div>
					@php($col1='ancho-80')
					@php($col2='ancho-20')

					<table class="ancho-100 table-fixed borde">
						<thead>
							<tr>
								<td class="{{ $col1 }}">Aplicacion</td>
								<td class="{{ $col2 }}">Disponible</td>
							</tr>
						</thead>
						<tbody class="alto-350-px">

							@foreach($aplicaciones as $id => $aplicacion)

								<tr>
									<td class="{{ $col1 }}">{{ $aplicacion }}</td>
									<td class="{{ $col2}} texto-centrar">
										<input
											type="checkbox"
											value="{{ $id }}"
											{{ $perfil->aplicaciones->pluck('id')->contains($id) ? 'checked' : '' }}
											name='aplicaciones[]'>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>

			</div>
		</div>
	</div>
</div>


<div class="conjunto-grupo">
	<div class="form-grupo ">
		<div class="form-renglon flex">
			<div class="form-columna ancho-50">
				<a class="form-btn btn-cancelar" href="{{ route('perfiles.index') }}">CANCELAR</a>
			</div>
			<div class="form-columna ancho-50 texto-derecha">
				<input class="form-btn btn-guardar" type="submit" value="GUARDAR">
			</div>
		</div>
	</div>
</div>