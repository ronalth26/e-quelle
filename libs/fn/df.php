<?php
if($_SERVER['HTTP_HOST']=='localhost'){
	define("HTTP_DIR","/");
}
else{
	//define("HTTP_DIR","http://".$_SERVER['HTTP_HOST']."/");
	define("HTTP_DIR","/");
}

define("EMAIL_ENVIA","contacto@petramas.com");
define("URL_IMG_YOUTUBE","http://img.youtube.com/vi/CLAVE/0.jpg");

define("NMB_PAG","");
define("NMB_ADMIN","Panel Administrable Equelle");

define("TOTAL_REGISTROS","20");
define("TOT_PAG_MOSTRAR","15");

define("OBJ_BANNER","files/banners/");
define("BANNER_AN1","1600");
define("BANNER_AL1","512");
define("BANNER_AL2","512");
define("BANNER_AN2","512");
define("BANNER_AL3","700");
define("BANNER_AN3","700");

define("OBJ_CLIENTE","files/clientes/");
define("CLIENTE_AN","205");
define("CLIENTE_AL","160");

define("OBJ_LOGO","files/logos/");
define("LOGO_AN","200");
define("LOGO_AL","150");

define("OBJ_SERVICIO","files/servicios/");
define("SERVICIO_AN1","140");
define("SERVICIO_AL1","140");
define("SERVICIO_AN2","320");
define("SERVICIO_AL2","320");

define("OBJ_NOTICIA","files/noticias/");
define("NOTICIA_AN1","255");
define("NOTICIA_AL1","255");

define("OBJ_RECLAMOS","files/reclamos/");

define("MAIL_CONTACTO","administracion@e-quelle.net");
//define("MAIL_CONTACTO","gprod@crystalstudio.pe");
define("MAIL_CONTENIDO",'<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>Mail Equelle</title></head><body><table width="610" border="0" cellpadding="0" cellspacing="0"><tr><td bgcolor="#fff"><table width="608" border="0" cellpadding="0" cellspacing="5"><tr><td align="left"><img src="'.HTTP_DIR.'assets/images/logo.png" style="height: 50px; margin-top: 40px; margin-bottom: 30px" alt="Equelle" /></td></tr></table></td></tr><tr><td><table width="608" border="0" cellpadding="0" cellspacing="5" bgcolor="#FFFFFF"><tr><td><font face="Arial, Helvetica, sans-serif" color="#000000" style="font-size:11px;">[TEXTO]</font></td></tr><tr><td>&nbsp;</td></tr></table></td></tr></table></body></html>');
?>