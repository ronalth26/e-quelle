<?php 
include("../libs/fb_xin.php");
include("../libs/fb_xam.php");
//Si no ha abieto sesión
if((isset($_GET['err']))&&(is_numeric($_GET['err'])))
{	if((isset($_POST['txt_uss']))&&(isset($_POST['txt_pss'])))
	{	$origen="admin";
		$acc="5";
		include("../libs/vi/Admin.php");
		die();
	}
	else
	{	switch(isset($_GET['erracc']))
		{	case 1: $vStrMensaje="No tiene acceso a esta área"; break;
			case 2: $vStrMensaje="Usuario o clave incorrectos. Inténtelo de nuevo"; break;
			case 0: $vStrMensaje="";break;
		}
		require("validar.php");
	}	
}
else{
	include("home.php");
}
?>