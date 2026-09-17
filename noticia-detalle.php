<?php	$vIntIdSeccion=5;
		$vStrBanner='bnoticias';
		include("libs/fb_xin.php");
		include("libs/fb_xwb.php");
		$acc=2;
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
	
	<div class="servicio-titulo">
		<div class="container">
			<h2><?php echo $vTitulo;?></h2>
		</div>
	</div>

	<div class="noticia">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-xs-12 text-center">
					<div class="fecha movil">
						Publicado: <?php echo $vFecha;?>
					</div>
					<div class="seccion-imagen">
						<div class="imagen">
							<div><p><img src="<?php echo $vRutaNoticia.$vFoto;?>"></p></div>
						</div>
					</div>
					
					
					
			<div class="redes movil">
    <div class="row" style="text-align: center; margin-bottom: 15px;">
        <div class="col-12">
            <p style="font-weight: bold; font-size: 16px;">Compartir en:</p>
        </div>
    </div>
    <div class="row" style="text-align: center;">
        <div class="col-md-3 col-xs-6 celda">
            <a href="javascript:popup('https://www.facebook.com/sharer/sharer.php?u=<?php echo $vSocialUrls; ?>','Facebook',450,400,'no',1);">
                <img src="ico/f.png" alt="Facebook" style="width: 46px; height: 46px; display: block; margin: 0 auto;">
                <span style="display: block; margin-top: 5px;">Facebook</span>
            </a>
        </div>
        <div class="col-md-3 col-xs-6 celda">
            <a href="javascript:popup('https://twitter.com/intent/tweet?text=<?php echo $vSeoTitulo; ?>&url=<?php echo $vSocialUrls; ?>&original_referer=<?php echo $vSocialUrls; ?>','X',450,400,'no',1);">
                <img src="ico/x.png" alt="X" style="width: 46px; height: 46px; display: block; margin: 0 auto;">
                <span style="display: block; margin-top: 5px;">X</span>
            </a>
        </div>
        <div class="col-md-3 col-xs-6 celda">
            <a href="javascript:popup('https://api.whatsapp.com/send?text=<?php echo urlencode($vSeoTitulo . ' ' . $vSocialUrls); ?>','WhatsApp',450,400,'no',1);">
                <img src="ico/w.png" alt="WhatsApp" style="width: 46px; height: 46px; display: block; margin: 0 auto;">
                <span style="display: block; margin-top: 5px;">WhatsApp</span>
            </a>
        </div>
        <div class="col-md-3 col-xs-6 celda">
            <a href="javascript:popup('https://www.tiktok.com/share?url=<?php echo $vSocialUrls; ?>&title=<?php echo $vSeoTitulo; ?>','TikTok',450,400,'no',1);">
                <img src="ico/t.png" alt="TikTok" style="width: 46px; height: 46px; display: block; margin: 0 auto;">
                <span style="display: block; margin-top: 5px;">TikTok</span>
            </a>
        </div>
    </div>
</div>

					
					
				</div>
				<div class="col-md-6 col-xs-12">
					<div class="fecha_movil web">
						Publicado: <?php echo $vFecha;?>
					</div>
					<div class="contenido">
						<div class="barra"></div>
						<div class="datos">
						<?php echo nl2br($vContenido);?>
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
<?php include("_pie.php");?>