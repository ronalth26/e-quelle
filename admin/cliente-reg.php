<?php 
include("ckeditor/ckeditor.php");
include("../libs/fb_xin.php");
include("../libs/fb_xam.php");	
include("../libs/vi/Cliente.php");
$vMenu=5;
?>
<?php include("ihea.php");?>
		<div class="h2">CLIENTES</div>
    	<div class="edit">
        <form name="frm_reg" id="frm_reg" method="post" action="javascript:valSimpleAjx1('','frm_reg','alerta','alerta',3,1,'',0);" enctype="multipart/form-data">
        	<input type="hidden" name="txtSv" id="txtSv" value="cliente-reg.php" />
        	<input type="hidden" name="acc" id="acc" value="3" />
        	<input type="hidden" name="pag" id="pag" value="<?php echo $vIntPagAct;?>" />
    	    <input name="txtId" id="txtId" type="hidden" value="<?php echo $vIdCliente;?>" />
        	<div id="alerta"></div>
    	  <table width="100%" border="0" cellspacing="0" class="tbl_reg">
    	    <tr>
    	      <th>INFORMACIÓN</th>
    	      <th>CONFIGURACIÓN</th>
  	      	</tr>
    	    <tr>
    	      <td width="70%" valign="top">
                <h4>Título</h4>
                <input type="text" name="txtTitulo" id="txtTitulo" class="text req" alt="título" maxlength="33" style="width:95%" value="<?php echo $vTitulo;?>" />
                <br /><br />
                <h4>Contenido</h4>
				<?php
				$oFCKeditor[0]= new CKEditor();
				$oFCKeditor[0]->returnOutput = true;
				$oFCKeditor[0]->basePath = 'ckeditor/';
				$pVar=array(
				$arrEd1
				);
				$oFCKeditor[0]->config = array(	"enterMode" => "2",
												"extraPlugins" => "tableresize", 
												"width" => '100%',
												"height" => 150,
												"toolbar" => $pVar,
												"skin" => 'v2'
											);
				echo $oFCKeditor[0]->editor('txtContenido', $vContenido);
				unset($oFCKeditor[0]);
				?>
				<br><br>
			  </td>
    	      <td width="30%" valign="top">
                <h4>Foto</h4>
                <input name="txtImg12" id="txtImg12" type="hidden" value="<?php echo $vFoto;?>" />
                <input name="txtImg11" id="txtImg11" type="file" class="text req" alt="foto" style="width:95%" />
                <input name="txtImg11lib" type="hidden" value="jpg,jpeg,gif,png,JPG,JPEG,GIF,PNG" />
                <br />
                Formatos: JPG,GIF. Peso máximo: 1.8Mb. Tamaño: <?php echo CLIENTE_AN." x ".CLIENTE_AL;?>
                <?php	if($vFoto!=""){?>
                <br />
                <a href="<?php echo $vRuta.$vFoto?>" title="Ver imagen" target="_blank">Ver imagen actual</a>
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
              </td>
  	      </tr>
    	    <tr>
    	      <td colspan="2" align="right" class="barra">
              	<input type="button" onclick="javascript:location.href='cliente.php';" name="button" id="button" value="VOLVER" class="cancelar" />
                &nbsp;&nbsp;&nbsp;
              	<input type="submit" name="button" id="button" value="ACEPTAR" class="guardar" />
              </td>
    	      </tr>
  	    </table>
        </form>
    	</div>
<?php include("ifoo.php");?>