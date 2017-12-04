@if( session()->has('info') )

	<div class="info {{ session('tipo') }} texto-centrar" >
		<span>{{ session('info') }}</span>
	</div>

{{-- 	<script>
		swal(
  'Registro Exitoso',
  '',
  'success'
)
	</script> --}}
@endif