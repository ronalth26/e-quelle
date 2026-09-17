<?php 
include("../libs/fb_xin.php");
include("../libs/fb_xam.php");	
include("../libs/vi/Logo.php");
$vMenu=3;
?>
<?php include("ihea.php");?>
		<div class="h2">logos home</div>
    	<div class="edit">
        <form name="frm_reg" id="frm_reg" method="post" action="javascript:valSimpleAjx1('','frm_reg','alerta','alerta',3,1,'',0);" enctype="multipart/form-data">
        	<input type="hidden" name="txtSv" id="txtSv" value="logo-reg.php" />
        	<input type="hidden" name="acc" id="acc" value="3" />
        	<input type="hidden" name="pag" id="pag" value="<?php echo $vIntPagAct;?>" />
    	    <input name="txtId" id="txtId" type="hidden" value="<?php echo $vId;?>" />
        	<div id="alerta"></div>
    	  <table width="100%" border="0" cellspacing="0" class="tbl_reg">
    	    <tr>
    	      <th>CONFIGURACIÓN</th>
    	      <!--<th>INFORMACIÓN</th>-->
  	      	</tr>
    	    <tr>
    	      <td width="50%" valign="top">
                <h4>Foto</h4>
                <input name="txtImg12" id="txtImg12" type="hidden" value="<?php echo $vFoto;?>" />
                <input name="txtImg11" id="txtImg11" type="file" class="text err" alt="foto" style="width:95%" />
                <input name="txtImg11lib" type="hidden" value="jpg,gif,png,JPG,GIF,PNG" />
                <br />
                Formatos: JPG,GIF,PNG. Peso máximo: 1.8Mb. Tamaño: <?php echo LOGO_AN." x ".LOGO_AL;?>
                <?php	if($vFoto!=""){?>
                <br />
                <a href="<?php echo $vRuta.$vFoto?>" title="Ver imagen" target="_blank">Ver imagen actual</a>
                <?php	}?>
                <br /><br />
              </td>
    	      <!--<td width="50%" valign="top">
              	<h4>Enlace</h4>
               	<input name="txtUrl" type="text" class="text req" id="txtUrl" style="width:95%" value="<?php echo $vUrl;?>" maxlength="150" alt="enlace" />
                <br /><br />
			  </td>-->
  	      </tr>
    	    <tr>
    	      <td colspan="2" align="right" class="barra">
              	<input type="button" onclick="javascript:location.href='logo.php';" name="button" id="button" value="VOLVER" class="cancelar" />
                &nbsp;&nbsp;&nbsp;
              	<input type="submit" name="button" id="button" value="ACEPTAR" class="guardar" />
              </td>
    	      </tr>
  	    </table>
        </form>
    	</div>
<?php include("ifoo.php");?>