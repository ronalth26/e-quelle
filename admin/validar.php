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
  	<br><br>
   	<div class="login"><img src="im/login.gif" width="456" height="387" alt="Login" class="img_left" />
   	  <div class="box_login">
      <form name="frm_log" id="frm_log" method="post" action="javascript:validar();">
          <table border="0" cellspacing="0" cellpadding="0" class="tbl_azul">
            <tr>
              <td>USUARIO:</td>
              <td><input type="text" name="txt_uss" id="txt_uss" class="text req" maxlength="30" style="width:85%" /></td>
            </tr>
            <tr>
              <td>CONTRASEÑA:</td>
              <td><input type="password" name="txt_pss" id="txt_pss" class="text req" maxlength="30" style="width:85%" /></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td align="center"><input type="image" name="imageField" id="imageField" src="im/btn-iniciarse.png" /></td>
            </tr>
          </table>
          <table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbl_opc">
            <tr>
              <td style="font-size:11px;"><input type="checkbox" name="chk_recordar" id="chk_recordar" />
              <label for="chk_recordar">Recordar Contraseña</label></td>
            </tr>
            <tr>
              <td style="font-size:11px;"><a href="recuperar.php" class="lnk" title="¿Olvidó su contraseña?. Recupérela aquí">¿Olvidó su contraseña?. Recupérela aquí</a></td>
            </tr>
          </table>
	  </form>
      </div>
      <br clear="all" />
  </div><br /><br />
    <div class="foot_log"><div class="txt">Diseñado y Desarrollado por Crystal Studio 2020</div></div>
</div>
</body>
</html>