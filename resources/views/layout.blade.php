<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Encuestas Online</title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="icon" href="/imagenes/favicon.png"/>

	<link rel="stylesheet" href="/css/estilo_contenido.css">
	<link rel="stylesheet" href="/css/estilo_layout.css">
	<link rel="stylesheet" href="/css/roquesystem.css">

	<script src="https://file.myfontastic.com/6CRLECjnYdYKU5BvcK7cQA/icons.js"></script>

	<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
	<script src="/js/script_ppal.js"></script>

	    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.css">

</head>
<body>

	<img class="img-fondo" src="/imagenes/fondo.jpg" alt="">

	<div class="cuerpo" >
		@if(auth()->check())
			@php($user = Auth::user())
			@php($user_nombre = $user->name)
		@else
			@php($user_nombre = 'Invitado')
		@endif
		@include('menu_lateral_izquierda')

		<div class="cabecera flex">
			<div class="ancho-1-3 flex" >
				<a class="flex flex-justificar" href="" id="mostrar_menu_lateral">
					<div class="btn-app-escrito-efecto flex flex-justificar">
						<div class="ancho-30 btn-app">
							<img src="/imagenes/iconos/icono-app.png" alt="">
						</div>
						<div class="ancho-70 btn-app-texto">
							<span>Aplicaciones</span>
						</div>
					</div>
				</a>
			</div>
			<div class="zona_logo_ppal ancho-1-3 flex">
				<a  href="" class="logo_ppal margen-auto">
					<img class="img_logo_proceso" src="/imagenes/logo-empresa.png" alt="">
				</a>
			</div>
			<div class="zona_usuario ancho-1-3 flex flex-derecha"  >

				<div class="btn_usuario zona_usuario_nombre" href="">

					<div class="circulo-usuario">
						<span class="btn_usuario_texto iniciales_usuario" id="zona_usuario_btn">RG</span>
					</div>

					<div class="menu-usuario" id="menu_usuario_flotante">
						<div class="flecha-up"></div>
						<div class="usuario-datos">
							<div class="nombre-usuario">
								<a href=""><span>{{ $user_nombre }}</span></a>
							</div>
							<ul class="menu-usuario-items">
								<li class="item">

                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Cerrar Sesión
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                 </li>
							</ul>
						</div>
					</div>
				</div>
			</div>

		</div>

		<div class="contenido-relleno-cabecera"></div>

		<div class="scrollbar contenido-ppal" id="style-5" >

			<div class="contenedor-ppal-volver ">
				<span class="btn-ppal-volver" href="" onclick="history.back()">
					<img class="btn-ppal-volver-icono" src="/imagenes/iconos/icono-volver.svg">
					<div class="btn-ppal-volver-escrito">Página Anterior</div>
				</span>
			</div>

			@yield('contenido')
		</div>

</body>
</html>