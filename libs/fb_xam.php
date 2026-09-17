<?php 
if((!isset($_SESSION['idAdmin']))&&(!isset($_GET['err']))){
	if(isset($_COOKIE['id_extreme'])) 
	{	$cookie = htmlentities($_COOKIE['id_extreme']);
		$cookie = explode("%",$cookie);
		$admin = $cookie[0];
		$id = $cookie[1];
		$ip = $cookie[2];
		if ($HTTP_X_FORWARDED_FOR == "")
			$ip2 = getenv(REMOTE_ADDR);
		else
			$ip2 = getenv(HTTP_X_FORWARDED_FOR);
		if($ip==$ip2){
			$oA=new Admin('');
			$listAdmin=$oA->validarCookie($admin,$id);
			if(is_array($listAdmin))
			{	$_SESSION['idAdmin']=$listAdmin[0]['id_admin'];
				$_SESSION['nombres']=$listAdmin[0]['str_nombres'];
				
				linkearURL("index.php");
				exit(0);
			}else
				linkearURL("index.php?err=0","1");
		}else
			linkearURL("index.php?err=0","1");
	}else
		linkearURL("index.php?err=0","1");
}

//Parámetros
if((isset($_GET['pag']))&&($_GET['pag']!="0")&&(is_numeric($_GET['pag'])))
	$vIntPagAct=trim($_GET['pag']);
elseif((isset($_POST['pag']))&&($_POST['pag']!="0")&&(is_numeric($_POST['pag'])))
	$vIntPagAct=trim($_POST['pag']);
else
	$vIntPagAct=1;
//Ajax
if((isset($_GET['ajx']))&&($_GET['ajx']!="0")&&(is_numeric($_GET['ajx'])))
	$vIntAjax=trim($_GET['ajx']);
elseif((isset($_POST['ajx']))&&($_POST['ajx']!="0")&&(is_numeric($_POST['ajx'])))
	$vIntAjax=trim($_POST['ajx']);
else
	$vIntAjax="";
//Mensaje
if((isset($_GET['msg']))&&($_GET['msg']!="0")&&(is_numeric($_GET['msg'])))
	$vIntMensaje=trim($_GET['msg']);
elseif((isset($_POST['msg']))&&($_POST['msg']!="0")&&(is_numeric($_POST['msg'])))
	$vIntMensaje=trim($_POST['msg']);
else
	$vIntMensaje="";
if($vIntMensaje!="")
{	switch($vIntMensaje)
	{	case 0: $vStrMensaje=ALERTA_ERROR_LISTADO1;break;
		case 1: $vStrMensaje=ALERTA_NUEVO;break;
		case 2: $vStrMensaje=ALERTA_MODIFICAR;break;
		case 3: $vStrMensaje=ALERTA_ELIMINAR;break;
		case 4: $vStrMensaje=ALERTA_ORDENAR;break;
		case 5: $vStrMensaje=ALERTA_ESTADO;break;
		case 6: $vStrMensaje=ALERTA_ERROR_PROCESO;break;
		case 7: $vStrMensaje=ALERTA_ERROR_USUARIO;break; 
		case 8: $vStrMensaje=ALERTA_ACCESO;break; 
		case 9: $vStrMensaje=ALERTA_PRINCIPAL;break; 
		case 10: $vStrMensaje=ALERTA_ENVIO;break; 
		case 11: $vStrMensaje=ALERTA_CARGA;break; 
	}
}else
	$vStrMensaje='';
//FCK Editor
if(stristr(strtolower($_SERVER['HTTP_HOST']),strtolower("www"))!="")
	$dirInicial=HTTP_DIR;
else
	$dirInicial=str_replace("www.","",HTTP_DIR);
//Acceso
if((isset($_GET['acc']))&&($_GET['acc']!=""))
	$acc=$_GET['acc'];
elseif((isset($_POST['acc']))&&($_POST['acc']!=""))
	$acc=$_POST['acc'];
else
	$acc=1;
//Acciones
switch($acc)
{	case "1":	$vStrAccion="lst";break;
	case "2":	$vStrAccion="reg";break;
	case "3":	$vStrAccion="reg";break;
	case "4":	$vStrAccion="del";break;
	case "5":	$vStrAccion="ord";break;
	case "6":	$vStrAccion="ban";break;
	case "7":	$vStrAccion="tvi";break;
	case "8":	$vStrAccion="des";break;
	case "9":	$vStrAccion="inc";break; // para incluir las paginas
	case "10":	$vStrAccion="con";break;
	case "11":	$vStrAccion="tar";break;
}
$vStrEnlacePag='';
$vStrEnlaceLst=$vStrEnlacePag."?acc=1&pag=".$vIntPagAct;
$vStrEnlaceReg=$vStrEnlacePag."?acc=2&pag=".$vIntPagAct;
$vStrEnlaceGua=$vStrEnlacePag."?acc=3&pag=".$vIntPagAct;
$vStrEnlaceDel=$vStrEnlacePag."?acc=4&pag=".$vIntPagAct;
$vStrEnlaceOrd=$vStrEnlacePag."?acc=5&pag=".$vIntPagAct;
$vStrEnlaceEst=$vStrEnlacePag."?acc=6&pag=".$vIntPagAct;
$vStrEnlaceCtG=$vStrEnlacePag."?acc=7&pag=".$vIntPagAct;
$vStrEnlaceDes=$vStrEnlacePag."?acc=8&pag=".$vIntPagAct;
$vStrEnlaceInc=$vStrEnlacePag."?acc=9&pag=".$vIntPagAct;
$vStrEnlaceCon=$vStrEnlacePag."?acc=10&pag=".$vIntPagAct;
$vStrEnlaceTar=$vStrEnlacePag."?acc=11&pag=".$vIntPagAct;

$arrLP=array("Arquitectural","Entretenimiento");
$arrCP=array("","Bañadores de Color","Cortinas de Agua","Pantallas Led","Proyector Gráfico","Luces Móviles","Consola de Luces","Efecto Discoteca","Teatro","Luminarias Led","Máquina de humo");

$arrEd1=array( 	'Source','-','Templates','Table','-','Bold','Italic','Underline','Strike','-', 
			'Cut','Copy','Paste','PasteText','PasteWord','-',
			'OrderedList','UnorderedList',
			'OrderedList','UnorderedList','-','NumberedList','BulletedList','-','Outdent','Indent',
			'JustifyLeft','JustifyCenter','JustifyRight','JustifyFull','JustifyBlock','-','TextColor','BGColor','-',
			'Link','Unlink','Anchor');
?>