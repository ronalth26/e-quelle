<?php 
include("../libs/fb_xin.php");
include("../libs/fb_xam.php");	
include("../libs/vi/Banner.php");
$vMenu=2;
?>
<?php include("ihea.php");?>
		<div class="h2">BANNERS</div>
    	<div class="edit">
        <form name="frm_reg" id="frm_reg" method="post" action="javascript:valSimpleAjx1('','frm_reg','alerta','alerta',3,1,'',0);" enctype="multipart/form-data">
        	<input type="hidden" name="txtSv" id="txtSv" value="banner-reg.php" />
        	<input type="hidden" name="acc" id="acc" value="3" />
    	    <input name="txtId" id="txtId" type="hidden" value="<?php echo $vId;?>" />
        	<div id="alerta"></div>
    	  <table width="100%" border="0" cellspacing="0" class="tbl_reg">
    	    <tr>
    	      <th>INGRESE SLIDER</th>
  	      	</tr>
    	    <tr>
    	      <td width="100%" valign="top">
                <h4>Foto</h4>
                <input name="txtImg12" id="txtImg12" type="hidden" value="<?php echo $vFoto;?>" />
                <input name="txtImg11" id="txtImg11" type="file" class="text err" alt="foto" style="width:95%" />
                <input name="txtImg11lib" type="hidden" value="jpg,gif,png,JPG,GIF,PNG" />
                <br />
                Formatos: JPG,GIF,PNG. Peso máximo: 1.8Mb. Tamaño: <?php echo BANNER_AN1." x ".BANNER_AL1;?>
                <?php	if($vFoto!=""){?>
                <br />
                <a href="<?php echo $vRuta.$vFoto?>" title="Ver imagen" target="_blank">Ver imagen actual</a>
                <?php	}?>
                <h4>Foto Movil</h4>
                <input name="txtImg22" id="txtImg22" type="hidden" value="<?php echo $vFotoB;?>" />
                <input name="txtImg21" id="txtImg21" type="file" class="text err" alt="foto" style="width:95%" />
                <input name="txtImg21lib" type="hidden" value="jpg,gif,png,JPG,GIF,PNG" />
                <br />
                Formatos: JPG,GIF,PNG. Peso máximo: 1.8Mb. Tamaño: <?php echo BANNER_AN2." x ".BANNER_AL2;?>
                <?php	if($vFotoB!=""){?>
                <br />
                <a href="<?php echo $vRuta.$vFotoB;?>" title="Ver imagen" target="_blank">Ver imagen actual</a>
                <?php	}?>
                <h4>Título</h4>
                <input type="text" name="txtTitulo" id="txtTitulo" class="text" alt="titulo" maxlength="30" style="width:95%" value="<?php echo $vTitulo;?>" />
                <h4>Subtítulo</h4>
    	        <input type="text" name="txtSubTitulo" id="txtSubTitulo" class="text" alt="subtitulo" maxlength="40" style="width:95%" value="<?php echo $vSubTitulo;?>" />
				<br />
				<h4>Resumen</h4>
    	        <input type="text" name="txtResumen" id="txtResumen" class="text" alt="resumen" maxlength="110" style="width:95%" value="<?php echo $vResumen;?>" />
				<br />
                <h4>Enlace</h4>
    	        <input type="text" name="txtEnlace" id="txtEnlace" class="text" alt="enlace" style="width:95%" value="<?php echo $vEnlace;?>" />
              </td>
  	      </tr>
    	    <tr>
    	      <td colspan="2" align="right" class="barra">
              	<input type="button" onclick="javascript:location.href='banner.php';" name="button" id="button" value="VOLVER" class="cancelar" />
                &nbsp;&nbsp;&nbsp;
              	<input type="submit" name="button" id="button" value="ACEPTAR" class="guardar" />
              </td>
    	      </tr>
  	    </table>
        </form>
    	</div>
<?php include("ifoo.php");?>