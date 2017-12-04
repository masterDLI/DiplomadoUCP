<div class="conjunto-grupo">
	<div class="form-grupo borde">
		<div class="form-renglon">
			<div class="form-columna">
				<label class="form-label" for="nombre">Encuesta</label>
				<input class="form-input" name="nombre" type="text" value="{{ $encuesta->nombre or old('nombre') }}">
				 <span class="form-error">{{ $errors->first('nombre') }}</span>
			</div>
		</div>

		@isset($encuesta->id)

			<div class="form-renglon">
				<label for=""></label>
				<div class="form-columna ancho-50">
					<a class="es-link" href="{{ route('resultados.index', ['id'=>$encuesta->id]) }}"><span style="color: red;">Configurar Resultados</span></a>
				</div>
			</div>

		@endisset

	</div>
</div>

<script>


$('.eliminar_pregunta').click(function(e){
	e.preventDefault();
	$form_activo=$(this);
	swal({
		  title: 'Are you sure?',
		  text: "You won't be able to revert this!",
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Yes, delete it!'
		}).then(
				function(){
					$('.form_pregunta'+id).submit();
				}
		);

});

</script>
