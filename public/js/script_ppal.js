$(document).ready(function(){

	//Oculta aviso en la pantalla cuando devuelve del redirect
	if ($(".info").length != 0) {
		$(".info").delay(3000).slideUp(300);
	}

	$(".menu-usuario").toggle();
	$(".menu-alertas").toggle();

	// Cierra el div de menu

	$(document).click(function(e){
        if(e.target.id!='menu_usuario_flotante' && e.target.id!='zona_usuario_btn'){//suponiendo q el div tiene el id=divi
            $('.menu-usuario').hide(200);
        }
        if(e.target.id!='menu_alertas_flotante' && e.target.id!='zona_alerta_btn' && e.target.id!='zona_alerta_cont_cant' && e.target.id!='zona_alerta_cant'){//suponiendo q el div tiene el id=divi
            $('.menu-alertas').hide(200);
        }
     });



	$('#mostrar_menu_lateral').click(function(e){
		e.preventDefault();
		// alert('mostrar menu lateral');
		$(".zona-menu-izquierda").css('margin-left','0');
		$(".lienzo-menu-izquierdo").addClass("lienzo-menu-izquierdo-activo");
	});

	$(".lienzo-menu-izquierdo").click(function(){
		$(this).removeClass('lienzo-menu-izquierdo-activo');
		$(".menu-izquierdo").removeClass('menu-izquierdo-activo');
		$(".zona-menu-izquierda").css('margin-left', '-340px');
		$(".zona-sub-aplicaciones").css('left','-310px');
		$(".zona-acciones").css('left', '-280px');
	});

	$('#ocultar-aplicaciones').click(function(e){
		e.preventDefault();
		$(".zona-menu-izquierda").css('margin-left', '-340px');
		$(".lienzo-menu-izquierdo").removeClass('lienzo-menu-izquierdo-activo');
	});

	$('#ocultar-sub-aplicaciones').click(function(e){
		e.preventDefault();
		$(".zona-sub-aplicaciones").css('left','-310px');
		$(".zona-acciones").css('left', '-280px');
	});

	$('#ocultar-acciones').click(function(e){
		e.preventDefault();
		$(".zona-acciones").css('left', '-280px');
	});

	$(".ver-sub-aplicacion").click(function(e){
		e.preventDefault();
		$(".zona-sub-aplicaciones").css('left', '0');
	});

	$(".ver-acciones").click(function(e){
		e.preventDefault();
		$(".zona-acciones").css('left', '0');
	});


	// $("#ocultar-aplicaciones").click(function(e){
	// 	e.preventDefault();
	// 	$('.menu-aplicaciones').css('left','-230px;');
	// 	$(this).css('left','-230px');
	// });


	// $(".btn_apps").click(function(e){
	// 	e.preventDefault();
	// 	// $(".menu-izquierdo").toggle();
	// 	// // $(".logo_proceso").addClass("spinner");
	// 	$(".menu-izquierdo").addClass('menu-izquierdo-activo');
	// 	$(".lienzo-menu-izquierdo").addClass('lienzo-menu-izquierdo-activo');
	// });



	$(".lienzo-menu-derecha").click(function(){
		$(this).removeClass('lienzo-menu-derecha-activo');
		$(".menu-derecha").removeClass('menu-derecha-activo');
	});

	$(".ver-menu-derecha").click(function(e){
		e.preventDefault();
		// $(".menu-izquierdo").toggle();
		// // $(".logo_proceso").addClass("spinner");
		$(".menu-derecha").addClass('menu-derecha-activo');
		$(".lienzo-menu-derecha").addClass('lienzo-menu-derecha-activo');
	});

	$(".btn_usuario_texto").click(function(e){
		e.preventDefault();
		$(".menu-usuario").toggle(200);
	});
	$(".btn_alertas_img").click(function(e){
		$(".menu-alertas").toggle(200);
	});

});