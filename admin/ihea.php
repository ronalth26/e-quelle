<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title><?php echo NMB_ADMIN;?></title>
<link rel="shortcut icon" href="../assets/images/favicon.ico">
<link rel="stylesheet" type="text/css" href="cs/css.css" />
<script language="javascript" type="text/javascript" src="js/jquery-1.3.2.js"></script>
<script language="javascript" type="text/javascript" src="js/val.js"></script>
<script language="javascript" type="text/javascript" src="js/form.js"></script>

<link type="text/css" rel="stylesheet" href="js/fechador/themes/ui-lightness/ui.all.css" />
<script type="text/javascript" language="javascript" src="js/fechador/ui/ui.core.js"></script>
<script type="text/javascript" language="javascript" src="js/fechador/ui/ui.datepicker.js"></script>
<script type="text/javascript" language="javascript" src="js/fechador/ui/i18n/ui.datepicker-es.js"></script>

<script language="javascript" type="text/javascript">
$(document).ready(function() {     
	$("#boton_xls").click(function(event) {
		$("#datos_a_enviar").val( $("<div>").append( 
			$("#exportar_xls").eq(0).clone()).html());
			$("#form_exportar").submit();});
	$("#cate").change(function(){
		$("#listado").submit();
	});
});
$(function() {
	$.datepicker.setDefaults($.extend({showMonthAfterYear: false}, $.datepicker.regional['es']));
	$("#txtFecha").datepicker({showOn: 'button', buttonImage: 'js/fechador/images/calendar.gif', buttonImageOnly: true, changeMonth: true, changeYear: true});
}); 
</script>
</head>
<body>
<div class="layer_b">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="t_la">
  <tr>
    <td valign="top" width="180" class="t_menu">
    	<div class="menu">
    	<div class="logo"><img src="im/logotipo-loguin.gif" width="210" alt="" /></div>
  		<ul>
        	<li><a href="home.php" <?php if($vMenu=="1") echo 'class="pr"';?> title="Bienvenida">Bienvenido</a></li>
        	<li class="principal"><a href="javascript:;" title="Página de Inicio" style="cursor:none;">Página de Inicio</a></li>
        	<li><a href="banner.php" <?php if($vMenu=="2") echo 'class="pr"';?> class="sub" title="Banners">Banners</a></li>
        	<li><a href="logo.php" <?php if($vMenu=="3") echo 'class="pr"';?> class="sub" title="Logos">Logos</a></li>
        	<li class="principal"><a href="servicio.php" <?php if($vMenu=="6") echo 'class="pr"';?> title="Servicios">Servicios</a></li>
        	<li class="principal"><a href="cliente.php" <?php if($vMenu=="5") echo 'class="pr"';?> title="Clientes">Clientes</a></li>
        	<li class="principal"><a href="noticia.php" <?php if($vMenu=="4") echo 'class="pr"';?> title="Noticias">Noticias</a></li>
        	<li class="principal"><a href="admin.php" <?php if($vMenu=="11") echo 'class="pr"';?> title="Administrador">Administrador</a></li>
        	<li class="principal"><a href="logout.php" title="Cerrar Sesión">Cerrar Sesión</a></li>
        </ul>
        </div>
    </td>
    <td width="100%" valign="top" class="data">
   	  <div class="header"><div class="txt">PANEL ADMINISTRABLE EQUELLE</div></div>