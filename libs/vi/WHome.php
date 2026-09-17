<?php
$obj=new Banner('');
$banners=$obj->listar();
$vRutaBan=HTTP_DIR.OBJ_BANNER;
unset($obj);

$obj=new Logo('');
$logos=$obj->listar('');
$vRutaLogo=HTTP_DIR.OBJ_LOGO;
unset($obj);

$obj=new Noticia('');
$noticias=$obj->listar('1','',1,3);
$vRutaNoticia=HTTP_DIR.OBJ_NOTICIA;
unset($obj);
?>