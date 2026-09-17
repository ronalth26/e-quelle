<?php	$vIntIdSeccion=6;
		$vStrBanner='bcontacto';
		include("libs/fb_xin.php");
		include("libs/fb_xwb.php");
		include("libs/vi/WFormulario.php");?>
<?php include("_cabecera.php");?>
<?php include("_menu.php");?>
<?php include("_banner.php");?>

	<!-- Conoce -->
	<div class="conoce">
		<div class="fondo" id="conoce-fondo">
			<div class="container box" id="conoce-texto">
				<h2><strong>Contactos</strong></h2>
				<div class="resumen1">En esta página encontrarás información ordenada y organizada sobre e quelle y como poder contactarte con nosotros. Estamos para servirte.</div>
			</div>
		</div>
	</div>
	
	<div class="contacto-detalle">
		<div class="container">
			<div class="contacto-contenido">
				<h2><strong>Datos de</strong> contacto</h2>
				<div class="row">
					<div class="col-md 4 col-xs-4 text-center">
						<div class="box">
							<img src="assets/images/contacto-1.jpg">
							<h4><span>TELÉFONO</span></h4>
							<div class="linea">
								<img src="assets/images/bandera1.svg" width="18" onerror="this.onerror=null; this.src='assets/images/bandera1.jpg'">
								(051) 959 376 040
							</div>
						<!--	<div class="linea">
								<img src="assets/images/bandera2.svg" width="18" onerror="this.onerror=null; this.src='assets/images/bandera2.jpg'">
								(52) 1 81 1599 0514
							</div>
							<div class="linea">
								<img src="assets/images/bandera3.svg" width="18" onerror="this.onerror=null; this.src='assets/images/bandera3.jpg'">
								&nbsp;
							</div> -->
						</div>
					</div>
					<div class="col-md 4 col-xs-4 text-center">
						<div class="box">
							<img src="assets/images/contacto-2.jpg">
							<h4><span>CORREO</span></h4>
							<div class="correo">
								<a href="mailto:administracion@e-quelle.net">administracion@e-quelle.net</a>
							</div>
						</div>
					</div>
					<div class="col-md 4 col-xs-4 text-center">
						<div class="box">
							<img src="assets/images/contacto-3.jpg">
							<h4><span>REDES SOCIALES</span></h4>
							<div class="redes">
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
		</div>
	</div>

	<div class="formulario">
		<div class="container">
			<div class="contacto-contenido">
				<h2><strong>Formulario de </strong>contactos</h2>
				<div class="resumen">
					Ingresa tus datos e información de contacto. Envíanos tus dudas, consultas o requerimientos y en breve un especialista se contactará contigo.
				</div>
				<form name="frmContacto" id="frmContacto" class="form" method="post" action="contactos.php">
					<input type="hidden" id="acc" name="acc" value="2">
					<div class="row">
					    
					    <!-- Honeypot para bot spam - Invisible para humanos -->
						<div style="height:0px; overflow:hidden; opacity:0; position:absolute; z-index:-1;">
							<input type="text" name="honey_pie" id="honey_pie" value="" autocomplete="off">
						</div>
						
						<div class="col-12"><div id="alerta1"></div></div>
						<div class="col-md-3 col-xs-12 titulo"><strong>Nombres completos</strong></div>
						<div class="col-md-9 col-xs-12 campo">
							<input type="text" class="text req" name="nombres" id="nombres" title="nombres completos" maxlength="150" placeholder="Escribe tus nombres">
						</div>
						
						<div class="col-md-3 col-xs-12 titulo"><strong>DNI</strong></div>
						<div class="col-md-9 col-xs-12 campo">
							<input type="text" class="text req" name="dni" id="dni" title="dni" maxlength="8" placeholder="Escribe tu DNI">
						</div>
						
						<div class="col-md-3 col-xs-12 titulo"><strong>Teléfonos</strong></div>
						<div class="col-md-9 col-xs-12 campo">
							<input type="text" class="text req" name="telefono" id="telefono" title="telefono" maxlength="10" placeholder="Escribe tu teléfono">
						</div>
						
						<div class="col-md-3 col-xs-12 titulo"><strong>Correo electrónico</strong></div>
						<div class="col-md-9 col-xs-12 campo">
							<input type="text" class="text req" name="correo" id="correo" title="correo electrónico" maxlength="150" placeholder="Escribe tu correo electrónico">
						</div>
						
						<div class="col-md-3 col-xs-12 titulo"><strong>Comentario</strong></div>
						<div class="col-md-9 col-xs-12 campo">
							<textarea class="textarea" name="contenido" id="contenido" title="contenido" placeholder="Escribe tus comentarios" rows="5"></textarea>
						</div>
						
						<div class="col-md-3 movil"></div>
						<div class="col-md-9 col-xs-12 botones">
							<button class="btn btn-primary" type="submit" style="width:150px;">
								Enviar
							</button>
							&nbsp;&nbsp;&nbsp;
							<button class="btn btn-primary" type="reset" style="width:150px;">
								Cancelar
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

<?php include("_pie.php");?>