<?php
$vSocialUrl	='';
$vTinMapa	='';
$vSliderPost='';
$vTinBlog	='';
$vVistaServicio=0;
if((isset($_GET['pag']))&&($_GET['pag']!="0")&&(is_numeric($_GET['pag'])))
	$vIntPagAct=trim($_GET['pag']);
elseif((isset($_POST['pag']))&&($_POST['pag']!="0")&&(is_numeric($_POST['pag'])))
	$vIntPagAct=trim($_POST['pag']);
else
	$vIntPagAct=1;

if((isset($_GET['msg']))&&($_GET['msg']!="0")&&(is_numeric($_GET['msg'])))
	$vIntMensaje=trim($_GET['msg']);
elseif((isset($_POST['msg']))&&($_POST['msg']!="0")&&(is_numeric($_POST['msg'])))
	$vIntMensaje=trim($_POST['msg']);
else
	$vIntMensaje="";
	
//Acceso
if((isset($_GET['acc']))&&($_GET['acc']!=""))
	$acc=$_GET['acc'];
elseif((isset($_POST['acc']))&&($_POST['acc']!=""))
	$acc=$_POST['acc'];
else
	$acc=1;

$obj=new Banner('');
$banner=$obj->listar();
unset($obj);
$vRutaBanner=HTTP_DIR.OBJ_BANNER;

$vSeoTag='e quelle | Consultoría en Sistemas de Gestión';
?>