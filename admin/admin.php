<?php 
include("ckeditor/ckeditor.php");
include("../libs/fb_xin.php");
include("../libs/fb_xam.php");
include("../libs/vi/Admin.php");
$vMenu=11;
?>
<?php 	include("ihea.php");?>
		<h2>MODIFICAR CONTRASEÑA DE ADMINISTRACIÓN</h2>
<?php	if($vStrMensaje!="") echo mostrar_msj($vStrMensaje);?>
    	<div class="edit">
			<form name="frm_edit" id="frm_edit" method="post" action="admin.php?acc=2" enctype="multipart/form-data">
              <table width="100%" border="0" cellspacing="0" class="tbl_reg">
                <tr>
                  <td width="155"><h4>Nombres: (*)</h4></td>
                  <td width="631"><input name="txt_nombre" type="text" class="text" id="txt_nombre" style="width:97%" value="<?php echo $vStrNombre;?>" maxlength="200" /></td>
                </tr>
                <tr>
                  <td width="155"><h4>Email: (*)</h4></td>
                  <td width="631"><input name="txt_email" type="text" class="text" id="txt_email" style="width:97%" value="<?php echo $vStrEmail;?>" maxlength="200" /></td>
                </tr>
                <tr>
                  <td><h4>Usuario: (*)</h4></td>
                  <td><input name="txt_uss" type="text" class="text" id="txt_uss" style="width:27%" value="<?php echo $vStrUss;?>" maxlength="30" /></td>
                </tr>
                <tr>
                  <td width="155"><h4>Contraseña: (*)</h4></td>
                  <td width="631"><input name="txt_pss" type="password" class="text" id="txt_pss" style="width:27%" value="<?php echo $vStrPss;?>" maxlength="30" /></td>
                </tr>
                <tr>
                  <td class="barra"><strong>* Datos requeridos</strong></td>
                  <td align="right" class="barra"><input type="button" name="button" id="button" value="ACEPTAR" class="guardar" onClick="javascript:val_adm();" /></td>
                </tr>
              </table>
			</form>
        </div>
    	<br />
    	<br />
    	<br />
    	<br />
<?php include("ifoo.php");?>