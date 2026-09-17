<?php	$vIntIdSeccion=4;
		$vStrBanner='bcliente';
		include("libs/fb_xin.php");
		include("libs/fb_xwb.php");
		$acc=1;
		include("libs/vi/WCliente.php");?>
<?php include("_cabecera.php");?>
<?php include("_menu.php");?>
<?php include("_banner.php");?>

	<!-- Conoce -->
	<div class="conoce">
		<div class="fondo" id="conoce-fondo">
			<div class="container box" id="conoce-texto">
				<h2><strong>Clientes</strong></h2>
				<div class="resumen1">En esta página encontrarás un listado ordenado y organizado de nuestros principales casos de éxito; cada cliente tiene un listado de servicios implementados y realizados a través del tiempo. Conoce nuestro trabajo.</div>
			</div>
		</div>
	</div>

	<div class="clientes">
		<div class="container">
			<div class="row">
<?php	if(validar_array($clientes)){
			foreach($clientes as $cli){?>
   				<div class="col-md-3 col-xs-6 celda2">
   					<div class="box">
   						<div class="flip-card">
						  <div class="flip-card-inner">
							<div class="flip-card-front">
							  	<div class="front">
									<img style="margin-top: 20px;" src="<?php echo $vRutaCliente.$cli->foto;?>">
									<span><?php echo $cli->titulo;?></span>
								</div>
							</div>
							<div class="flip-card-back">
							  	<div class="back">
									<span><?php echo $cli->titulo;?></span>
									<div class="informacion">
										<?php echo $cli->contenido;?>
									</div>
								</div>
							</div>
						  </div>
						</div>
   					</div>
   				</div>
<?php		}
		}?>
   				<p class="clear"></p>
			</div>
		</div>
	</div>
	
	<div class="paginado">
		<div class="fondo">
			<div class="container text-center">
				<?php echo paginacion2("clientes.php",$vIntPagAct,$vIntNumPag);?>
			</div>
		</div>
	</div>
<?php include("_pie.php");?>