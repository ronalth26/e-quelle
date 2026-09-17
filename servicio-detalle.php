<?php	$vIntIdSeccion=3;
		$vTinMetodologia=1;
		$vStrBanner='bservicios';
		include("libs/fb_xin.php");
		include("libs/fb_xwb.php");
		$acc=2;
		include("libs/vi/WServicio.php");?>
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
	
	<div class="servicio-titulo">
		<div class="container">
			<h2><strong><?php echo $vTitulo;?></strong></h2>
		</div>
	</div>
	<div class="noticia web">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-xs-12 text-center">
					<div id="carousel-mov" class="carousel slide carousel-fade" data-ride="carousel">
						<!--Slides-->
						<div class="carousel-inner" role="listbox">
						<?php	$vContador=0; 
								if($vFoto1!=""){?>
							<div class="carousel-item active">
								<div class="seccion-imagen"><div class="imagen"><div><p><img src="<?php echo $vRutaServicio."gr/".$vFoto1;?>" alt="First slide"></p></div></div></div>
							</div>
						<?php 		$vContador++;
								}if($vFoto2!=""){?>
							<div class="carousel-item">
								<div class="seccion-imagen"><div class="imagen"><div><p><img src="<?php echo $vRutaServicio."gr/".$vFoto2;?>" alt="Second slide"></p></div></div></div>
							</div>
						<?php 		$vContador++;
								}if($vFoto3!=""){?>
							<div class="carousel-item">
								<div class="seccion-imagen"><div class="imagen"><div><p><img src="<?php echo $vRutaServicio."gr/".$vFoto3;?>" alt="Third slide"></p></div></div></div>
							</div>
						<?php 		$vContador++;
								}if($vFoto4!=""){?>
							<div class="carousel-item">
								<div class="seccion-imagen"><div class="imagen"><div><p><img src="<?php echo $vRutaServicio."gr/".$vFoto4;?>" alt="Fourth slide"></p></div></div></div>
							</div>
						<?php 		$vContador++;
								}?>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-xs-12">
					<div class="sub-titulo">
						<div><?php echo $vResumen;?></div>
					</div>
					<div class="contenido">
						<div class="datos">
							<?php echo nl2br($vContenido);?>
						</div>
						<div class="container">
						<div class="row">
							<div class="col-md-6 col-xs-12">
								<h4>BENEFICIOS</h4>
								<?php echo $vBeneficios;?>
							</div>
							<div class="col-md-6 col-xs-12">
								<h4>PORQUE ELEGIR EQUELLE: </h4>
								<?php echo $vEleccion;?>
							</div>
						</div>
						</div>
					</div>
					<div class="redes web" style="position: relative;">
						<div class="row" style="position: relative;">
							<div class="col-md-6 col-xs-12 celda">
								<a href="javascript:popup('https://www.facebook.com/sharer/sharer.php?u=<?php echo $vSocialUrls;?>','Facebook',450,400,'no',1);">
									Compartir en Facebook
									<i class="fa fa-facebook" aria-hidden="true"></i>
								</a>
							</div>
							<div class="col-md-6 col-xs-12 celda">
								<a href="javascript:popup('https://twitter.com/intent/tweet?text=<?php echo $vSeoTitulo;?>&url=<?php echo $vSocialUrls;?>&original_referer=<?php echo $vSocialUrls;?>','Twitter',450,400,'no',1);">
									Compartir en Twitter
									<i class="fa fa-twitter" aria-hidden="true"></i>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="servicio movil">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-xs-12 text-center">
					<div id="carousel-thumb" class="carousel slide carousel-fade carousel-thumbnails" data-ride="carousel">
						<!--Slides-->
						<div class="carousel-inner" role="listbox">
						<?php	$vContador=0; 
								if($vFoto1!=""){?>
							<div class="carousel-item active">
								<div class="seccion-imagen"><div class="imagen"><div><p><img src="<?php echo $vRutaServicio."gr/".$vFoto1;?>" alt="First slide"></p></div></div></div>
							</div>
						<?php 		$vContador++;
								}if($vFoto2!=""){?>
							<div class="carousel-item">
								<div class="seccion-imagen"><div class="imagen"><div><p><img src="<?php echo $vRutaServicio."gr/".$vFoto2;?>" alt="Second slide"></p></div></div></div>
							</div>
						<?php 		$vContador++;
								}if($vFoto3!=""){?>
							<div class="carousel-item">
								<div class="seccion-imagen"><div class="imagen"><div><p><img src="<?php echo $vRutaServicio."gr/".$vFoto3;?>" alt="Third slide"></p></div></div></div>
							</div>
						<?php 		$vContador++;
								}if($vFoto4!=""){?>
							<div class="carousel-item">
								<div class="seccion-imagen"><div class="imagen"><div><p><img src="<?php echo $vRutaServicio."gr/".$vFoto4;?>" alt="Fourth slide"></p></div></div></div>
							</div>
						<?php 		$vContador++;
								}?>
						</div>
						<!--/.Slides-->
						<!--Controls-->
						<a class="carousel-control-prev" href="#carousel-thumb" role="button" data-slide="prev">
							<span class="carousel-control-prev-icon" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="carousel-control-next" href="#carousel-thumb" role="button" data-slide="next">
							<span class="carousel-control-next-icon" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						</a>
						<!--/.Controls-->
						<ol class="carousel-indicators">
						<?php	$vContador=0; 
								if($vFoto1!=""){?>
							<li data-target="#carousel-thumb" data-slide-to="<?php echo $vContador;?>" class="active"><span><img class="d-block w-100" src="<?php echo $vRutaServicio.$vFoto1;?>"
								class="img-fluid"></span></li>
						<?php 		$vContador++;
								}if($vFoto2!=""){?>
							<li data-target="#carousel-thumb" data-slide-to="<?php echo $vContador;?>"><span><img class="d-block w-100" src="<?php echo $vRutaServicio.$vFoto2;?>"
								class="img-fluid"></span></li>
						<?php 		$vContador++;
								}if($vFoto3!=""){?>
							<li data-target="#carousel-thumb" data-slide-to="<?php echo $vContador;?>"><span><img class="d-block w-100" src="<?php echo $vRutaServicio.$vFoto3;?>"
								class="img-fluid"></span></li>
						<?php 		$vContador++;
								}if($vFoto4!=""){?>
							<li data-target="#carousel-thumb" data-slide-to="<?php echo $vContador;?>"><span><img class="d-block w-100" src="<?php echo $vRutaServicio.$vFoto4;?>"
								class="img-fluid"></span></li>
						<?php 		$vContador++;
								}?>
						</ol>
						</div>
				</div>
				<div class="col-md-6 col-xs-12">
					<h3><?php echo $vResumen;?></h3>
					<div class="contenido">
						<div class="datos">
						<?php echo nl2br($vContenido);?>
						</div>
						<div class="row">
							<div class="col-md-6 col-xs-12">
								<h4>BENEFICIOS</h4>
								<?php echo $vBeneficios;?>
							</div>
							<div class="col-md-6 col-xs-12">
								<h4>PORQUE ELEGIR EQUELLE: </h4>
								<?php echo $vEleccion;?>
							</div>
						</div>
					</div>
					<div class="redes">
						<div class="row">
							<div class="col-md-6 col-xs-12 celda">
								<a href="javascript:popup('https://www.facebook.com/sharer/sharer.php?u=<?php echo $vSocialUrls;?>','Facebook',450,400,'no',1);">
									Compartir en Facebook
									<i class="fa fa-facebook" aria-hidden="true"></i>
								</a>
							</div>
							<div class="col-md-6 col-xs-12 celda">
								<a href="javascript:popup('https://twitter.com/intent/tweet?text=<?php echo $vSeoTitulo;?>&url=<?php echo $vSocialUrls;?>&original_referer=<?php echo $vSocialUrls;?>','Twitter',450,400,'no',1);">
									Compartir en Twitter
									<i class="fa fa-twitter" aria-hidden="true"></i>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="metodologia movil">
		<div class="container">
			<h2><strong>Metodología </strong>Equelle</h2>
			<div class="lista">
				<div class="row">
					<div class="col-md-1 col-xs-12 movil">
						&nbsp;
					</div>
					<div class="col-md-4 col-xs-12">
						<div class="box-metodologia uno impar wow slideInLeft" data-wow-duration="600ms" data-wow-delay="300ms">
							<img src="assets/images/uno-ico.svg" width="40" onerror="this.onerror=null; this.src='assets/images/uno-ico.jpg'">
							<p>Etapa:</p>
							<h5>Diagnóstico</h5>
							<span class="resumen">
								Se identifica qué documentación se viene<br>
								desarrollando actualmente y qué queda<br>
								pendiente a desarrollar en base a los<br>
								requerimientos del Sistema de Integrado<br>
								de Gestión, requerimientos de clientes,<br>
								procedimientos internos y normativa legal<br>
								vigente.
							</span>
						</div>
					</div>
					<div class="col-md-2 colx-xs-1 text-center movil wow slideInLeft" data-wow-duration="600ms" data-wow-delay="900ms">
						<img class="metodologia-flecha" src="assets/images/flecha-1.png">
					</div>
					<div class="col-md-4 col-xs-12">
						<div class="box-metodologia par dos wow slideInLeft" data-wow-duration="500ms" data-wow-delay="1500ms">
							<img src="assets/images/dos-ico.svg" width="40" onerror="this.onerror=null; this.src='assets/images/dos-ico.jpg'">
							<p>Etapa:</p>
							<h5>Elaboración documental</h5>
							<span class="resumen">
								Junto con las áreas del alcance se<br>
								desarrolla la documentación necesaria<br>
								para el cumplimiento de la norma,<br>
								procedimientos internos y legales vigente.<br>
								Se adecuan los documentos actuales a los<br>
								requerimientos de la norma.
							</span>
							<img class="flecha_abajo movil wow slideInDown" data-wow-duration="300ms" data-wow-delay="2000ms" src="assets/images/flecha-2.png">
						</div>
					</div>
					<div class="col-md-1 col-xs-12 movil">
						&nbsp;
					</div>


					<div class="col-md-4 col-xs-12">
						<div class="box-metodologia impar cuatro wow slideInRight" data-wow-duration="600ms" data-wow-delay="3500ms">
							<img src="assets/images/cuatro-ico.svg" width="40" onerror="this.onerror=null; this.src='assets/images/cuatro-ico.jpg'">
							<p>Etapa:</p>
							<h5>Auditoría interna</h5>
							<span class="resumen">
								Verificación de la correcta implementación<br>
								de los procedimientos. Auditor interno por<br>
								parte de la consultora con el fin de cumplir<br>
								con los principios de independencia.
							</span>
							<img class="flecha_abajo movil wow slideInDown" data-wow-duration="300ms" data-wow-delay="4100ms" src="assets/images/flecha-2.png">
						</div>
					</div>
					<div class="col-md-4 colx-xs-1 text-center movil wow slideInRight" data-wow-duration="600ms" data-wow-delay="2900ms">
						<img class="metodologia-flecha" src="assets/images/flecha-3.png">
					</div>
					<div class="col-md-4 col-xs-12">
						<div class="box-metodologia par tres wow slideInRight" data-wow-duration="600ms" data-wow-delay="2300ms">
							<img src="assets/images/tres-ico.svg" width="40" onerror="this.onerror=null; this.src='assets/images/tres-ico.jpg'">
							<p>Etapa:</p>
							<h5>Implementación</h5>
							<span class="resumen">
								Generación de los registros que<br>
								evidencien el cumplimiento de lo<br>
								establecido en la etapa documental.<br>
								Sensibilización del personal en el uso de<br>
								herramientas de gestión y sus<br>
								procedimientos.
							</span>
						</div>
					</div>

					<div class="col-md-1 col-xs-12 movil">
						&nbsp;
					</div>
					<div class="col-md-4 col-xs-12">
						<div class="box-metodologia impar cinco wow slideInLeft" data-wow-duration="600ms" data-wow-delay="4400ms">
							<img src="assets/images/cinco-ico.svg" width="40" onerror="this.onerror=null; this.src='assets/images/cinco-ico.jpg'">
							<p>Etapa:</p>
							<h5>Apoyo durante<br>la certificación</h5>
							<span class="resumen">
								Apoyo al cliente durante el proceso de<br>
								auditoría de certificación, en el contacto<br>
								con la certificadora, recomendaciones para<br>
								la elección de equipo auditor y<br>
								acompañamiento durante la auditoría de<br>
								certificación.
							</span>
						</div>
					</div>
					<div class="col-md-2 colx-xs-1 movil wow slideInLeft" data-wow-duration="600ms" data-wow-delay="5000ms">
						<img class="metodologia-flecha" src="assets/images/flecha-5.png">
					</div>
					<div class="col-md-4 col-xs-12">
						<div class="box-metodologia par seis wow slideInLeft" data-wow-duration="600ms" data-wow-delay="5600ms">
							<img src="assets/images/seis-ico.jpg">
						</div>
					</div>
					<div class="col-md-1 col-xs-12 movil">
						&nbsp;
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="metodologia web">
		<div class="container">
			<h2><strong>Metodología </strong>Equelle</h2>
			<div class="lista">
				<div class="row">
					<div class="col-md-4 col-xs-12">
						<div class="box-metodologia uno impar">
							<img src="assets/images/uno-ico.svg" width="40" onerror="this.onerror=null; this.src='assets/images/uno-ico.jpg'">
							<p>Etapa:</p>
							<h5>Diagnóstico</h5>
							<span class="resumen">
								Se identifica qué documentación se viene
								desarrollando actualmente y qué queda
								pendiente a desarrollar en base a los
								requerimientos del Sistema de Integrado
								de Gestión, requerimientos de clientes,
								procedimientos internos y normativa legal
								vigente.
							</span>
						</div>
					</div>
					<div class="col-md-4 col-xs-12">
						<div class="box-metodologia par dos">
							<img src="assets/images/dos-ico.svg" width="40" onerror="this.onerror=null; this.src='assets/images/dos-ico.jpg'">
							<p>Etapa:</p>
							<h5>Elaboración documental</h5>
							<span class="resumen">
								Junto con las áreas del alcance se
								desarrolla la documentación necesariaEquelle
								para el cumplimiento de la norma,Equelle
								procedimientos internos y legales vigente.Equelle
								Se adecuan los documentos actuales a losEquelle
								requerimientos de la norma.
							</span>
						</div>
					</div>
					<div class="col-md-4 col-xs-12">
						<div class="box-metodologia par tres">
							<img src="assets/images/tres-ico.svg" width="40" onerror="this.onerror=null; this.src='assets/images/tres-ico.jpg'">
							<p>Etapa:</p>
							<h5>Implementación</h5>
							<span class="resumen">
								Generación de los registros queEquelle
								evidencien el cumplimiento de loEquelle
								establecido en la etapa documental.Equelle
								Sensibilización del personal en el uso deEquelle
								herramientas de gestión y susEquelle
								procedimientos.
							</span>
						</div>
					</div>
					<div class="col-md-4 col-xs-12">
						<div class="box-metodologia impar cuatro">
							<img src="assets/images/cuatro-ico.svg" width="40" onerror="this.onerror=null; this.src='assets/images/cuatro-ico.jpg'">
							<p>Etapa:</p>
							<h5>Auditoría interna</h5>
							<span class="resumen">
								Verificación de la correcta implementación
								de los procedimientos. Auditor interno por
								parte de la consultora con el fin de cumplir
								con los principios de independencia.
							</span>
						</div>
					</div>
					<div class="col-md-4 col-xs-12">
						<div class="box-metodologia impar cinco">
							<img src="assets/images/cinco-ico.svg" width="40" onerror="this.onerror=null; this.src='assets/images/cinco-ico.jpg'">
							<p>Etapa:</p>
							<h5>Apoyo durante la certificación</h5>
							<span class="resumen">
								Apoyo al cliente durante el proceso de
								auditoría de certificación, en el contacto
								con la certificadora, recomendaciones para
								la elección de equipo auditor y
								acompañamiento durante la auditoría de
								certificación.
							</span>
						</div>
					</div>
					<div class="col-md-4 col-xs-12">
						<div class="box-metodologia par seis">
							<img style="width: 90%" src="assets/images/seis-ico.jpg">
						</div>
					</div>
					<div class="col-md-1 col-xs-12 movil">
						&nbsp;
					</div>
				</div>
			</div>
		</div>
	</div>
<?php include("_pie.php");?>