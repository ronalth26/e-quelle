<?php	$vIntIdSeccion=3;
		$vStrBanner='bservicios';
		include("libs/fb_xin.php");
		include("libs/fb_xwb.php");
		$acc=1;
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

	<div class="listaser">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-xs-12">
					<h3><strong>Seleccione otra</strong> categoría de servicio:</h3>
				</div>
				<div class="col-md-6 col-xs-12">
					<form name="buscador" id="buscador" method="get" action="servicio-lista.php" onChange="javascript:submit();">
						<select class="select" name="tipo-servicio" id="tipo-servicio">
							<option value="1" <?php if($vIdTipo=='1') echo 'selected';?>>Consultoría</option>
							<option value="2" <?php if($vIdTipo=='2') echo 'selected';?>>Capacitaciones online y presenciales</option>
							<option value="3" <?php if($vIdTipo=='3') echo 'selected';?>>Auditorías</option>
							<option value="4" <?php if($vIdTipo=='4') echo 'selected';?>>Mejora de procesos</option>
						</select>
					</form>
					<div class="icono">
						<div>
							<img src="files/servicios/iconos-servicios<?php echo $vIdTipo;?>.svg" width="181" onerror="this.onerror=null; this.src='files/servicios/iconos-servicios<?php echo $vIdTipo;?>.jpg'">	
						</div>
					</div>
				</div>
			</div>
			<div class="row my-3">
<?php	if(validar_array($servicios)){
			foreach($servicios as $ser){?>
				<div class="col-md-3 col-xs-6 celda2">
					<div class="box">
						<a href="servicio-detalle.php?item=<?php echo $ser->id_servicio;?>">
							<div class="imagen">
								<div><p><em class="img"><img src="<?php echo $vRutaServicio.$ser->id_servicio."/".$ser->foto1;?>"></em></p></div>
							</div>
							<span><?php echo $ser->titulo;?></span>
							<p class="btn btn-primary">
								Más información del servicio
							</p>
						</a>
					</div>
				</div>
<?php		}
		}?>
			</div>
		</div>
	</div>
	
	<div class="paginado">
		<div class="fondo">
			<div class="container text-center">
				<?php echo paginacion2("servicio-lista.php?tipo=". $vIdTipo,$vIntPagAct,$vIntNumPag);?>
			</div>
		</div>
	</div>
<?php include("_pie.php");?>