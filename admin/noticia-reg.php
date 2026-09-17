<?php 
include("ckeditor/ckeditor.php");
include("../libs/fb_xin.php");
include("../libs/fb_xam.php");	
include("../libs/vi/Noticia.php");
$vMenu=4;
?>
<?php include("ihea.php");?>
		<div class="h2">NOTICIAS</div>
    	<div class="edit">
        <form name="frm_reg" id="frm_reg" method="post" action="javascript:valSimpleAjx1('','frm_reg','alerta','alerta',3,1,'',0);" enctype="multipart/form-data">
        	<input type="hidden" name="txtSv" id="txtSv" value="noticia.php" />
        	<input type="hidden" name="acc" id="acc" value="3" />
        	<input type="hidden" name="pag" id="pag" value="<?php echo $vIntPagAct;?>" />
          <input name="txtId" id="txtId" type="hidden" value="<?php echo $vIntIdNoticia;?>" />
          <input name="radResaltado" id="radResaltado" type="hidden" value="0">
        	<div id="alerta"></div>
    	  <table width="100%" border="0" cellspacing="0" class="tbl_reg">
    	    <tr>
    	      <th>INFORMACIÓN</th>
    	      <th>&nbsp;</th>
  	      	</tr>
    	    <tr>
    	      <td width="50%" valign="top">
                <h4>Fecha</h4>
                <input type="text" name="txtFecha" id="txtFecha" class="text req" alt="fecha" style="width:12%" value="<?php echo $vFecha;?>" />
                <br /><br />
                <h4>Título</h4>
                <input type="text" name="txtTitulo" id="txtTitulo" class="text req" alt="título" maxlength="85" style="width:95%" value="<?php echo $vTitulo;?>" />
                <br /><br />
                <h4>Resumen</h4>
                <input type="text" name="txtResumen" id="txtResumen" class="text" alt="resumen" maxlength="115" style="width:95%" value="<?php echo $vResumen;?>" />
                <br /><br />
            </td>
    	      <td width="50%" valign="top">
                <h4>Foto</h4>
                <input name="txtImg12" id="txtImg12" type="hidden" value="<?php echo $vFoto;?>" />
                <input name="txtImg11" id="txtImg11" type="file" class="text req" alt="foto principal" style="width:95%" />
                <input name="txtImg11lib" id="txtImg11lib" type="hidden" value="jpg,jpeg,gif,JPG,JPEG,GIF,png,PNG" />
                <br />
                Formatos: JPG,GIF,PNG. Peso máximo: 1.8Mb. Tamaño: <?php echo NOTICIA_AN1." x ".NOTICIA_AL1;?>
                <?php	if($vFoto!=""){?>
                <br />
                <a href="<?php echo $vRuta.$vFoto;?>" title="Ver imagen" target="_blank">Ver imagen actual</a>
                <?php	}?>
                <br /><br />
                <h4>Estado</h4>
                <label>
                	<input type="radio" name="radEstado" id="radEstado" value="1" <?php if($vEstado=='1') echo 'checked="checked"';?> />Si
                </label>
                &nbsp;&nbsp;
                <label>
                	<input type="radio" name="radEstado" id="radEstado" value="0" <?php if($vEstado=='0') echo 'checked="checked"';?> />No
                </label>
                <br /><br />
              </td>
  	      	</tr>
    	    <tr>
    	      <td colspan="2">
                <h4>Contenido</h4>
            </td>
          </tr>
    	    <tr>
    	      <td colspan="2">
                <textarea rows="10" style="width:100%;" name="txtContenido" id="txtContenido" maxlength="11000" class="textarea req" alt="contenido" cols="8"><?php echo $vContenido;?></textarea>
                <br><br>
            </td>
          </tr>
    	    <tr>
    	      <td colspan="2" align="right" class="barra">
              	<input type="button" onclick="javascript:location.href='noticia.php';" name="button" id="button" value="VOLVER" class="cancelar" />
                &nbsp;&nbsp;&nbsp;
              	<input type="submit" name="button" id="button" value="ACEPTAR" class="guardar" />
              </td>
    	      </tr>
  	    </table>
        </form>
    	</div>
<?php include("ifoo.php");?>