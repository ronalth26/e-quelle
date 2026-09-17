
	<!-- Footer -->

	<footer>
		<div class="fondo">
			<div class="container">
				<div class="row">
					<div class="col-md-4 col-xs-12 movil">
						<div class="copyright">
							Todos los derechos reservados.
							<br>
							Diseñado y desarrollado por Crystal Studio 2020
						</div>
					</div>
					<div class="col-md-4 col-xs-6 celda" style="position: relative;">
						<img src="/assets/images/logo_blanco.svg" class="logo_blanco" onerror="this.onerror=null; this.src='assets/images/logo_blanco.png'">
					</div>
					<div class="col-md-4 col-xs-6 celda">
						<div class="redes">
							<span class="movil">Redes sociales: </span>
							<a href="https://www.facebook.com/eQuelle.net" target="_blank">
								<i class="fa fa-facebook" aria-hidden="true"></i>
							</a>
							<a href="https://www.linkedin.com/company/equelle-oficial/" target="_blank">
								<i class="fa fa-linkedin" aria-hidden="true"></i>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
</div>
<div id="proyecto" style="display:none;">
<div class="popup">
	<div class="text-center">
		<h2><strong>Solicita</strong> algún servicio</h2>
	</div>
	<div class="resumen">
		Ingresa tu solicitud de servicio. Envíanos tus consultas o requerimiento y un especialista te responderá en breve.
	</div>
	<div class="container">
		<div class="row">
			<form name="frmSolicitud" id="frmSolicitud" class="form" method="post" action="javascript:;">
				<input type="hidden" id="acc" name="acc" value="3">
				<div class="container-fluid">
					<div class="row">
					    
					    <!-- Honeypot para bot spam - Invisible para humanos -->
						<div style="height:0px; overflow:hidden; opacity:0; position:absolute; z-index:-1;">
							<input type="text" name="honey_pie" id="honey_pie_sol" value="" autocomplete="off">
						</div>
						
						<div class="col-12" id="alerta2"></div>
						<div class="col-3 titulo"><strong>Nombres completos</strong></div>
						<div class="col-9 campo">
							<input type="text" class="text req" name="nombres_sol" id="nombres_sol" maxlength="150" title="nombres completos" placeholder="Escribe tus nombres">
						</div>
						
						<div class="col-3 titulo"><strong>DNI</strong></div>
						<div class="col-9 campo">
							<input type="text" class="text req" name="dni_sol" id="dni_sol" title="dni" maxlength="8" placeholder="Escribe tu DNI">
						</div>
						
						<div class="col-3 titulo"><strong>Teléfonos</strong></div>
						<div class="col-9 campo">
							<input type="text" class="text req" name="telefono_sol" id="telefono_sol" title="telefono" maxlength="10" placeholder="Escribe tu teléfono">
						</div>
						
						<div class="col-3 titulo"><strong>Correo electrónico</strong></div>
						<div class="col-9 campo">
							<input type="text" class="text req" name="correo_sol" id="correo_sol" title="correo electrónico"  maxlength="150" placeholder="Escribe tu correo electrónico">
						</div>
						
						<div class="col-3 titulo"><strong>Solicitud comercial</strong></div>
						<div class="col-9 campo">
							<textarea class="textarea" name="contenido_sol" id="contenido_sol" title="contenido" placeholder="Escribe tu solicitud" rows="3"></textarea>
						</div>
						
						<div class="col-md-3 movil"></div>
						<div class="col-md-9 col-xs-12 botones">
							<button class="btn btn-primary" type="submit">
								Enviar
							</button>
							&nbsp;&nbsp;&nbsp;
							<button class="btn btn-primary" type="reset">
								Cancelar
							</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="/assets/jsc/bootstrap4/popper.js"></script>
<script src="/assets/jsc/bootstrap4/bootstrap.min.js"></script>
<script src="/assets/pluginsjs/lightcasejs/src/js/lightcase.js"></script>
<?php	if($vIntIdSeccion=='1'){?>
<script src="/assets/pluginsjs/owlcarousel/owl.carousel.js"></script>
<script src="/assets/pluginsjs/owlcarousel/owl.js"></script>
<?php	}else{?>
<script src="/assets/pluginsjs/nivoslider/jquery.nivo.slider.js"></script>
<?php	}?>
<script src="/assets/pluginsjs/easing/easing.js"></script>
<script src="/assets/pluginsjs/parallax-js-master/parallax.min.js"></script>
<script src="/assets/jsc/jq.functions.js"></script>
<script src="/assets/jsc/jq.valid.campo.js"></script>
<script src="/assets/jsc/jq.numeric.js"></script>
<script src="/assets/jsc/jq.validador.js"></script>
<script src="/assets/jsc/custom.js"></script>
<script src="/assets/jsc/wow.min.js"></script>
<script>
$(window).resize(function(){
	$("#conoce-fondo").height($("#conoce-texto").height()-40);
});
$(document).ready(function(){
	$('#nombres').validCampoFranz('abcdefghijklmnñopqrstuvwxyzáéíóúÁÉÍÓÚñÑÜü ');
	$("#dni").numeric({ decimal: false, negative: false }, function() { this.value = ""; this.focus(); });
	$("#telefono").numeric({ decimal: false, negative: false }, function() { this.value = ""; this.focus(); });	
	$("#correo").blur(function(){validar_email($("#correo"));});

    $("#frmContacto").submit(function() {
		if(!valSimpleAjx1('frmContacto','alerta1','alerta1','AJAX','',''))
			return false;
    });
	$("#conoce-fondo").height($("#conoce-texto").height()-40);
	//$("#proyecto").css("display","1200px");
	$('a[data-rel^=lightcase]').lightcase({
		overlayOpacity: .85,
		maxWidth: ($(window).width() * 0.9),
		inline: {
			width: ($(window).width() * 0.9) + 'px'
		},
		forceWidth: false,
		forceHeight: true,
		maxHeight: 600,
		onFinish: {
			corge: function () {
				if($( window ).height() <= 580) {
					$(".popup").css({ "min-height": ($( window ).height()-50) + "px", "height": ($( window ).height()-50) + "px" });
				}
				$('#nombres_sol').validCampoFranz('abcdefghijklmnñopqrstuvwxyzáéíóúÁÉÍÓÚñÑÜü ');
				$("#dni_sol").numeric({ decimal: false, negative: false }, function() { this.value = ""; this.focus(); });
				$("#telefono_sol").numeric({ decimal: false, negative: false }, function() { this.value = ""; this.focus(); });
				$("#correo_sol").blur(function(){validar_email($("#correo_sol"));});

				$("#frmSolicitud").submit(function() {
					if(!valSimpleAjx1('frmSolicitud','alerta2','alerta2','NONE','',''))
						return false;
					else{
						$.ajax({
							type: "POST",
							url: 'contactos.php',
							data: $("#frmSolicitud").serialize(),
							success: function(data) {
								$("#alerta2").html(data);
								$("#frmSolicitud")[0].reset();
								return false;
							},
							error: function(err) {
								alert(err);
							}
						});
					}
				});
			}
		}
	});
<?php	if($vIntIdSeccion!='1'){?>
	$('#slider').nivoSlider({
		directionNav: false,
        controlNav: false
	});
<?php	}
		if($vIntIdSeccion=='4'){?>
<?php	}
		if(isset($vTinMetodologia)){
			if($vTinMetodologia=='1'){?>
	var alturaMetodologia = $(".box-metodologia").height();
	var alturaFlechaMetodologia = $(".metodologia-flecha").height();
	$(".metodologia-flecha").css('padding-top', parseInt((alturaMetodologia-alturaFlechaMetodologia)/2)+'px');
<?php		}
		}
		if($vIntIdSeccion=='2'){?>
	$(".img_fondo").css("height",$("#fondo_confiar").height()+'px');
<?php	}
		if($vIntIdSeccion=='1'){?>
			$('.carrusel_logo').owlCarousel({
				loop:true,
				margin:10,
				autoplay: true,
				autoplayTimeout: 4000,
				responsive:{
					0:{
						nav:false,
						items:2
					},
					600:{
						nav:false,
						items:3
					},
					1000:{
						nav:true,
						items:5
					}
				},
				navText : ["<i class='fa fa-chevron-right'></i>","<i class='fa fa-chevron-left'></i>"]
			})
	$('.carrusel-noticias').owlCarousel({
		loop:true,
		margin:10,
		nav:true,
		autoplay: true,
		autoplayTimeout: 8000,
		items: 1,
		navText : ["<i class='fa fa-chevron-right'></i>","<i class='fa fa-chevron-left'></i>"]
	})
<?php	}?>
<?php	if($vVistaServicio==1){?>
	window.scrollTo(0,480);
<?php	}?>
});
</script>
</body>
</html>