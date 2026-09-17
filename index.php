<?php	$vIntIdSeccion=1;
		include("libs/fb_xin.php");
		include("libs/fb_xwb.php");
		include("libs/vi/WHome.php");?>
<?php include("_cabecera.php");?>
<?php include("_menu.php");?>


    <style>
    .whatsapp-bubble {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background: #25D366;
        color: white;
        padding: 12px 18px;
        border-radius: 25px;
        font-size: 15px;
        font-weight: bold;
        text-decoration: none;
        box-shadow: 0 4px 10px rgba(0,0,0,0.3);
        z-index: 9999;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    
    .whatsapp-bubble:hover {
        transform: scale(1.05);
        box-shadow: 0 6px 14px rgba(0,0,0,0.35);
    }
    </style>

    <!-- Burbuja de WhatsApp -->
    <a href="https://wa.me/51959376040?text=Hola,%20deseo%20recibir%20información%20sobre%20sus%20servicios%20de%20consultoría.%20¿Me%20pueden%20orientar%20por%20favor?" 
       class="whatsapp-bubble" 
       target="_blank">
        ¿Necesitas ayuda? <br>  <img src="wsp2.png" style="width:30px;height:30px;margin-right:1px;" > Escríbenos por WhatsApp
    </a>

	<!-- Home -->
	<div class="home">
		<div class="home_slider_container">ad
			
			<!-- Home Slider -->
			<div class="owl-carousel owl-theme owl-carousel-banner banner-home-web" style="display:none">
<?php	foreach($banners as $ban){?>
				<div class="owl-slide owl-slide-animated d-flex align-items-center cover" style="background-image:url(<?php echo $vRutaBan.$ban->foto;?>)">
					<div class="container owl-slide-text">
				  		<div class="row justify-content-center justify-content-md-start">
							<div class="col-8 col-md-5 col-xs-8 static">
						  		<div class="owl-textos">
									<h2 class="owl-slide-animated owl-slide-title owl-titulo">
										<?php echo $ban->titulo?>
										<span><?php echo $ban->subtitulo;?></span>
									</h2>
									<div class="owl-slide-animated owl-slide-subtitle owl-resumen mb-3">
										<div class="movil"><?php echo $ban->resumen?></div>
<?php 		if($ban->enlace!=""){?>
										<div class="text-left">
											<a class="btn btn-outline-primary owl-slide-cta" href="<?php echo $ban->enlace;?>" target="_blank" role="button">Más información aquí</a>
										</div>
<?php		}?>
									</div>
						  		</div>
							</div>
					  	</div>
					</div>
		  		</div>
<?php	}?>
			</div>
			<!-- Home Slider -->
			<div class="owl-carousel owl-theme owl-carousel-banner banner-home-movil" style="display:none">
<?php	foreach($banners as $ban){?>
				<div class="owl-slide owl-slide-animated d-flex align-items-center cover" style="background-image:url(<?php echo $vRutaBan.$ban->fotob;?>)">
					<div class="container owl-slide-text">
				  		<div class="row justify-content-center justify-content-md-start">
							<div class="col-8 col-md-5 col-xs-8 static">
						  		<div class="owl-textos">
									<h2 class="owl-slide-animated owl-slide-title owl-titulo">
										<?php echo $ban->titulo?>
										<span><?php echo $ban->subtitulo;?></span>
									</h2>
									<div class="owl-slide-animated owl-slide-subtitle owl-resumen mb-3">
										<div class="movil"><?php echo $ban->resumen?></div>
<?php 		if($ban->enlace!=""){?>
										<div class="text-left">
											<a class="btn btn-outline-primary owl-slide-cta" href="<?php echo $ban->enlace;?>" target="_blank" role="button">Más información aquí</a>
										</div>
<?php		}?>
									</div>
						  		</div>
							</div>
					  	</div>
					</div>
		  		</div>
<?php	}?>
			</div>
		</div>
		
	</div>
	
	<!-- Fragmento de evento para página de conversión -->
    <script>
        gtag('event', 'conversion', {
            'send_to': 'AW-11503524819/EpwBCMeB7YoaENO3p-0q'
        });
    </script>


	<!-- Conoce -->
	<div class="conoce">
		<div class="fondo" id="conoce-fondo">
			<div class="container box" id="conoce-texto">
				<h2><strong>Conoce a </strong> e quelle</h2>
				<div class="resumen">Descubre los motivos por que Equelle es tu mejor opción, venimos trabajando desde hace más de 18 años de experiencia comprobada</div>
				<ul class="lista">
					<li>
						<div>2002</div>
						Iniciamos actividades pensando en dar las mejores soluciones a las empresas.
						<p>
							SOMOS EMPRENDEDORES.
						</p>
					</li>
					<li>
						<div>ISO 9001:2015</div>
						Desde el 2017 en Equelle Certificamos en ISO 9001:2015.
						<p>
							CONOCEMOS EL CAMINO POR LO QUE HEMOS.
						</p>
					</li>
					<li>
						<div>AUDITOR IRCA</div>
						Contamos en nuestro equipo 1 de los 3 Auditores Principales inscritos en IRCA.
						<p>
							TENEMOS UN EQUIPO ALTAMENTE CALIFICADO.
						</p>
					</li>
					<li>
						<div>2017</div>
						Nos internacionalizamos creando soluciones a otros países.
						<p>
							NOS DESARROLLAMOS EN EL MERCADO MEXICANO.
						</p>
					</li>
					<li>
						<div>2019</div>
						Reconocimiento por el Ministerio del Ambiente en haber calculado y validado las emisiones de Gases de Efecto Invernadero.
					</li>
				</ul>
				<p class="clear"></p>
			</div>
		</div>
	</div>
	
	<!-- Líneas de servicios -->
	<div class="lineas">
		<div class="container">
			<h2><strong>Líneas </strong> de servicios</h2>
			<div class="resumen">
				Encuentra toda nuestra información de servicios organizada y categorizada por nuestras 4 líneas, ingresa y conócenos.
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-md-3 col-xs-6 celda">
					<div class="box">
						<img src="files/servicios/linea_1.jpg">
						<h4>Consultorías</h4>
						<div>
							¨Implementación y certificación en normas nacionales e internacionales, que permiten acceder a nuevos mercados, mejorar la productividad, ambiente de trabajo y relación con el medio ambiente; junto a los consultores más experimentados¨
						</div>
						<a href="servicio-lista.php?tipo=1" class="btn btn-primary owl-slide-animated">Mayor información aquí</a>
					</div>
				</div>
				<div class="col-md-3 col-xs-6 celda">
					<div class="box">
						<img src="files/servicios/linea_2.jpg">
						<h4>Capacitaciones</h4>
						<div>
							Reforzamos sus habilidades para hablar el mismo idioma cuando hablemos de gestión. Contamos con métodos y plataformas diseñadas especificamente para lograr el éxito.
						</div>
						<a href="servicio-lista.php?tipo=2" class="btn btn-primary owl-slide-animated">Mayor información aquí</a>
					</div>
				</div>
				<div class="col-md-3 col-xs-6 celda">
					<div class="box">
						<img src="files/servicios/linea_3.jpg">
						<h4>Auditorías</h4>
						<div>
							Auditores calificados por la autoridad competente y experiencia en diferentes sectores, registrados en IRCA y autorizados por el Ministerio de Trabajo; auditorias desarrolladas de acuerdo a los requerimientos establecidos por el SEMARNAT
						</div>
						<a href="servicio-lista.php?tipo=3" class="btn btn-primary owl-slide-animated">Mayor información aquí</a>
					</div>
				</div>
				<div class="col-md-3 col-xs-6 celda">
					<div class="box">
						<img src="files/servicios/linea_4.jpg">
						<h4>Mejoras en procesos</h4>
						<div>
						Ofrecemos una solución integral. Incluimos Vigilancia Médica, Soluciones digitales, Seguimiento a los requisitos legales, Evaluación de proveedores, Monitoreos Ambientales y Ocupacionales y mejoras a través de Lean Change Management
						</div>
						<a href="servicio-lista.php?tipo=4" class="btn btn-primary owl-slide-animated">Mayor información aquí</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<!-- Experiencia -->
	<div class="experiencia" style="position: relative;">
		<div class="container">
			<h2><strong>Nuestra</strong> experiencia</h2>
			<div class="resumen">Conoce a los clientes con quienes hemos trabajado en conjunto diversos proyectos y se han convertido en nuestros casos de éxito.</div>
			<div style="margin-bottom:50px">
			<div class="logos carrusel_logo owl-carousel" style="position: relative;">
<?php	if(validar_array($logos)){
			foreach($logos as $logo){?>
				<div class="item">
					<img src="<?php echo $vRutaLogo.$logo->foto;?>">
				</div>
<?php		}
		}?>
			</div>
			</div>
		</div>
	</div>

	<!-- Noticias -->
	<div class="noticias">
		<div class="container">
			<h2><strong>Últimas </strong>noticias</h2>
			<div class="resumen">Mantente informado con nuestras últimas noticias, novedades y temas relacionados<br>a la gestión empresarial que te conecte con tu mercado.</div>
			<div class="lista">
				<div class="carrusel-noticias owl-carousel">
<?php	if(validar_array($noticias)){
			foreach($noticias as $not){?>
				<div class="box">
					<div class="imagen">
						<div><img src="<?php echo $vRutaNoticia.$not->foto;?>"></div>
					</div>
					<div class="textos">
						<h4><?php echo $not->titulo;?> 
						<span><?php echo $not->resumen?>...</span>
						</h4>
						<a style="visible: visible !important; display: inline-block !important;" href="noticia-detalle.php?item=<?php echo $not->id_noticia;?>" class="btn btn-primary" style="display: inline-block !important">Mayor información aquí</a>
					</div>
					<p class="clear"></p>
				</div>
<?php		}
		}?>
				</div>
			</div>
		</div>
	</div>
<?php include("_pie.php");?>