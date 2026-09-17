<?php
include("../libs/fb_xin.php");
if((isset($_GET['acc']))&&($_GET['acc']==2)){
	$acc=7;
	include("../libs/vi/Admin.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo NMB_ADMIN;?></title>
<link rel="stylesheet" type="text/css" href="cs/css.css" />
<script language="javascript" type="text/javascript" src="js/val.js"></script>
</head>
<body>
<div class="layer">
	<div class="head_log">
  		PANEL ADMINISTRABLE EQUELLE
  	</div>
   	<div class="login">
        <img src="im/login.gif" width="456" height="387" alt="Login" class="img_left" />
  	  <div class="box_login">
      <form name="frm_log" id="frm_log" method="post" action="recuperar.php?acc=2">
          <table border="0" cellspacing="0" cellpadding="0" class="tbl_azul">
<?php	if((isset($_GET['msj']))&&(($_GET['msj']=="")||($_GET['msj']=="0"))){?>
            <tr>
              <td colspan="2">Ingrese el email registrado para recuperar su contraseña.</td>
            </tr>
<?php	}if((isset($_GET['msj']))&&($_GET['msj']=="1")){?>
            <tr>
              <td colspan="2"><center><strong><small>Se ha enviado un mensaje con los datos de acceso a la cuenta registrada. Haga clic en CONTINUAR para volver a la página de inicio</small></strong></center></td>
            </tr>
            <tr>
              <td colspan="2" align="center"><input type="button" name="button" id="button" value="Continuar" onclick="javascript:location.href='index.php';" /></td>
            </tr>
<?php	}else{
			if((isset($_GET['msj']))&&($_GET['msj']=="0")){?>
            <tr>
              <td colspan="2">Email no registrado, vuelva a intentarlo</td>
            </tr>
<?php		}?>
            <tr>
              <td width="92" align="right">E-mail:</td>
              <td width="218"><input type="text" name="txt_uss" id="txt_uss" class="text req" maxlength="200" style="width:90%" /></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td align="center"><input type="submit" name="button2" id="button2" value="Enviar" />&nbsp;&nbsp;&nbsp;<input type="button" name="button" id="button" value="Cancelar" onclick="javascript:location.href='index.php';" /></td>
            </tr>
<?php	}?>
          </table>
	  </form>
      </div>
      <br clear="all" />
  </div>
    <div class="foot_log"><div class="txt">Diseñado y Desarrollado por Crystal Studio 2020</div></div>
</div>
</body>
</html>