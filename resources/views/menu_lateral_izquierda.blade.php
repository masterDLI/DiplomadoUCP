<div class="lienzo-menu-izquierdo"></div>
<div class="zona-menu-izquierda">

		<div class="zona-aplicaciones">
			<div class="lista-aplicaciones scroll " id="style-3">
				<div class="titulo-menu">APLICACIONES</div>

				@php( $aplicaciones = auth()->user()->aplicaciones() )

				@foreach($aplicaciones as $aplicacion)
					<div class="aplicacion">
						<a class="ver-sub-aplicacion-" href="{{ $aplicacion->url }}"><span>{{ $aplicacion->aplicacion }}</span></a>
					</div>
				@endforeach


			</div>
			<a class="zona-imagen-aplicaciones" id="ocultar-aplicaciones" href="">
				<img class="iconos-menu" src="/imagenes/iconos/icono-volver.svg" alt="">
			</a>
		</div>

		<!-- Sub Aplicaciones -->
{{-- 		<div class="zona-sub-aplicaciones">
			<div class="lista-sub-aplicaciones scroll " id="style-3">
				<div class="titulo-menu">Titulo</div>
				<?php for ($i=0; $i < 50; $i++) { ?>
					<div class="aplicacion">
						<a class="ver-acciones" href=""><span>Sub-Aplicaciones <?php echo $i; ?></span></a>
					</div>
				<?php } ?>
			</div>
			<a class="zona-imagen-sub-aplicaciones" id="ocultar-sub-aplicaciones" href="">
				<img class="iconos-menu" src="/imagenes/iconos/icono-volver.svg" alt="">
			</a>
		</div> --}}

		<!-- acciones -->
{{-- 		<div class="zona-acciones">
			<div class="lista-acciones scroll " id="style-3">
				<div class="titulo-menu">Titulo</div>
				<?php for ($i=0; $i < 50; $i++) { ?>
					<div class="aplicacion">
						<a href=""><span>Acciones <?php echo $i; ?></span></a>
					</div>
				<?php } ?>
			</div>
			<a class="zona-imagen-acciones" id="ocultar-acciones" href="">
				<img class="iconos-menu" src="/imagenes/iconos/icono-volver.svg" alt="">
			</a>

		</div> --}}
</div>