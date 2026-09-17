<?php	$vIntIdSeccion=3;
		$vStrBanner='bservicios';
		include("libs/fb_xin.php");
		include("libs/fb_xwb.php");?>
<?php include("_cabecera.php");?>
<?php include("_menu.php");?>
<?php include("_banner.php");?>

	<!-- Conoce -->
	<div class="conoce">
		<div class="fondo" id="conoce-fondo">
			<div class="container box" id="conoce-texto">
				<h2><strong>Servicios</strong></h2>
				<div class="resumen1">En esta página encontrarás un listado ordenado y organizado de nuestros principales servicios empresariales. Encuentra las soluciones que necesitas para tu empresa.</div>
			</div>
		</div>
	</div>

	<div class="cateser">
		<div class="container">
			<h2><strong>Seleccione la categoría </strong>del servicio de su interés</h2>
			<div class="lista">
				<div class="row">
					<div class="col-md-3 col-xs-12 laterales celda2">
						<a class="box" href="servicio-lista.php?tipo=1">
							<img src="files/servicios/cateser1.png">
							<p>Consultorías</p>
							<span>
								Lo acompañamos en la implementación y certificación en normas nacionales e internacionales que le permitan acceder a nuevos mercados y mejorar su productividad, ambiente de trabajo y relación con el medio ambiente, junto con un equipo de consultores experimentados y métodos amigables.
							</span>
						</a>
					</div>
					<div class="col-md-3 col-xs-12 celda2">
						<a class="box" href="servicio-lista.php?tipo=2">
							<img src="files/servicios/cateser2.png">
							<p>Capacitaciones online y presencial</p>
							<span>
								Reforzamos sus habilidades para hablar sobre temas de gestión. Contamos con métodos y plataformas diseñadas específicamente para lograr el éxito.
							</span>
						</a>
					</div>
					<div class="col-md-3 col-xs-12 celda2">
						<a class="box" href="servicio-lista.php?tipo=3">
							<img src="files/servicios/cateser3.png">
							<p>Auditorías</p>
							<span>
								Tenemos auditores calificados por la autoridad competente y experiencia en diferentes sectores, nuestro equipo incluye a auditores registrados en IRCA. Los cuales están autorizados por el Ministerio de Trabajo y auditorias desarrolladas de acuerdo a los requerimientos establecidos por el SEMARNAT.
							</span>
						</a>
					</div>
					<div class="col-md-3 col-xs-12 laterales celda2">
						<a class="box" href="servicio-lista.php?tipo=4">
							<img src="files/servicios/cateser4.png">
							<p>Mejora de procesos</p>
							<span>
								Vamos más allá del servicio y te ofrecemos una solución integral. Incluimos Vigilancia Médica, Soluciones digitales, Seguimiento a los requisitos legales, Evaluación de proveedores, Monitoreos Ambientales y Ocupacionales y mejoras a través de Lean Change Management.
							</span>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php include("_pie.php");?>