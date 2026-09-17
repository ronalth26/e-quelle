<?php	$vIntIdSeccion=5;
		$vStrBanner='bnoticias';
		include("libs/fb_xin.php");
		include("libs/fb_xwb.php");
		$acc=1;
		include("libs/vi/WNoticia.php");?>
<?php include("_cabecera.php");?>
<?php include("_menu.php");?>
<?php include("_banner.php");?>

	<!-- Conoce -->
	<div class="conoce">
		<div class="fondo" id="conoce-fondo">
			<div class="container box" id="conoce-texto">
				<h2><strong>Noticias</strong></h2>
				<div class="resumen1">En esta página encontrarás un listado ordenado y organizado de noticias de nuestra comunidad, mercado y empresa; cada noticia está pensada en brindarte información relevante y útil. Ingresa e infórmate.</div>
			</div>
		</div>
	</div>

	<div class="listanot">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-xs-12">
					<h3><strong>Seleccione alguna</strong> de nuestras noticias</h3>
				</div>
			</div>
			<div class="row my-3">
<?php	if(validar_array($listado)){
			foreach($listado as $not){?>
				<div class="col-md-3 col-xs-6 celda2">
					<div class="box">
						<a href="noticia-detalle.php?item=<?php echo $not->id_noticia;?>">
							<div class="fecha">
								Publicado: <?php echo fecha_normal($not->fecha);?>
							</div>
							<div class="imagen">
								<div><p><em class="img"><img src="<?php echo $vRutaNoticia.$not->foto;?>"></em></p></div>
							</div>
							<span><?php echo $not->titulo;?></span>
							<div class="resumen"><?php echo $not->resumen;?> ...</div>
							<p class="btn btn-primary">
								Ver la noticia completa aquí
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
				<?php echo paginacion2("noticias.php",$vIntPagAct,$vIntNumPag);?>
			</div>
		</div>
	</div>
<?php include("_pie.php");?>