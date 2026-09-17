<?php 
include("ckeditor/ckeditor.php");
include("../libs/fb_xin.php");
include("../libs/fb_xam.php");	
include("../libs/vi/Servicio.php");
$vMenu=6;
?>
<?php include("ihea.php");?>
		<div class="h2">SERVICIOS</div>
    	<div class="edit">
        <form name="frm_reg" id="frm_reg" method="post" action="javascript:valSimpleAjx1('','frm_reg','alerta','alerta',3,1,'',0);" enctype="multipart/form-data">
        	<input type="hidden" name="txtSv" id="txtSv" value="servicio-reg.php" />
        	<input type="hidden" name="acc" id="acc" value="3" />
        	<input type="hidden" name="pag" id="pag" value="<?php echo $vIntPagAct;?>" />
    	    <input name="txtId" id="txtId" type="hidden" value="<?php echo $vIdServicio;?>" />
    	    <input name="tipo" id="tipo" type="hidden" value="<?php echo $vIdTipo;?>" />
        	<div id="alerta"></div>
    	  <table width="100%" border="0" cellspacing="0" class="tbl_reg">
    	    <tr>
    	      <th>INFORMACIÓN</th>
    	      <th>&nbsp;</th>
  	      	</tr>
    	    <tr>
    	      <td width="50%" valign="top">
                <h4>Categoría</h4>
                <?php echo strtoupper($vStrNombretipo);?>
                <br /><br />
                <h4>Título</h4>
                <input type="text" name="txtTitulo" id="txtTitulo" class="text req" alt="título" maxlength="58" style="width:95%" value="<?php echo $vTitulo;?>" />
                <br /><br />
                <h4>Resumen</h4>
                <input type="text" name="txtResumen" id="txtResumen" class="text" alt="resumen" maxlength="110" style="width:95%" value="<?php echo $vResumen;?>" />
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
    	      <td width="50%" valign="top">
                <!--<h4>Foto de lista</h4>
                <input name="txtImg12" id="txtImg12" type="hidden" value="<?php echo $vFoto;?>" />
                <input name="txtImg11" id="txtImg11" type="file" class="text err" alt="foto principal" style="width:95%" />
                <input name="txtImg11lib" id="txtImg11lib" type="hidden" value="jpg,gif,JPG,GIF,png,PNG,JPEG,jpeg" />
                <br />
                Formatos: JPG,GIF. Peso máximo: 1.8Mb. Tamaño: <?php echo SERVICIO_AN2." x ".BLOG_AL1;?>
                <?php	if($vFoto!=""){?>
                <br />
                <a href="<?php echo $vRuta.$vFoto;?>" title="Ver imagen" target="_blank">Ver imagen actual</a>
                <?php	}?>
                <br /><br />-->
                <h4>Foto1 (Principal)</h4>
                <input name="txtImg12" id="txtImg12" type="hidden" value="<?php echo $vFoto1;?>" />
                <input name="txtImg11" id="txtImg11" type="file" class="text err" alt="foto 1" style="width:95%" />
                <input name="txtImg11lib" id="txtImg11lib" type="hidden" value="jpg,gif,JPG,GIF,png,PNG,JPEG,jpeg" />
                <br />
                Formatos: JPG,GIF. Peso máximo: 1.8Mb. Tamaño: <?php echo SERVICIO_AN2." x ".SERVICIO_AL2;?>
                <?php	if($vFoto1!=""){?>
                <br />
                <a href="<?php echo $vRuta.$vFoto1;?>" title="Ver imagen" target="_blank">Ver imagen actual</a>
                <?php	}?>
                <br /><br />
                <h4>Foto 2</h4>
                <input name="txtImg22" id="txtImg22" type="hidden" value="<?php echo $vFoto2;?>" />
                <input name="txtImg21" id="txtImg21" type="file" class="text err" alt="foto 2" style="width:95%" />
                <input name="txtImg21lib" id="txtImg21lib" type="hidden" value="jpg,gif,JPG,GIF,png,PNG,JPEG,jpeg" />
                <br />
                Formatos: JPG,GIF. Peso máximo: 1.8Mb. Tamaño: <?php echo SERVICIO_AN2." x ".SERVICIO_AL2;?>
                <?php	if($vFoto2!=""){?>
                <br />
                <a href="<?php echo $vRuta.$vFoto2;?>" title="Ver imagen" target="_blank">Ver imagen actual</a>
                <?php	}?>
                <br /><br />
                <h4>Foto 3</h4>
                <input name="txtImg32" id="txtImg32" type="hidden" value="<?php echo $vFoto3;?>" />
                <input name="txtImg31" id="txtImg31" type="file" class="text err" alt="foto 3" style="width:95%" />
                <input name="txtImg31lib" id="txtImg31lib" type="hidden" value="jpg,gif,JPG,GIF,png,PNG,JPEG,jpeg" />
                <br />
                Formatos: JPG,GIF. Peso máximo: 1.8Mb. Tamaño: <?php echo SERVICIO_AN2." x ".SERVICIO_AL2;?>
                <?php	if($vFoto3!=""){?>
                <br />
                <a href="<?php echo $vRuta.$vFoto3;?>" title="Ver imagen" target="_blank">Ver imagen actual</a>
                <?php	}?>
                <br /><br />
                <h4>Foto 4</h4>
                <input name="txtImg42" id="txtImg42" type="hidden" value="<?php echo $vFoto4;?>" />
                <input name="txtImg41" id="txtImg41" type="file" class="text err" alt="foto 4" style="width:95%" />
                <input name="txtImg41lib" id="txtImg41lib" type="hidden" value="jpg,gif,JPG,GIF,png,PNG,JPEG,jpeg" />
                <br />
                Formatos: JPG,GIF. Peso máximo: 1.8Mb. Tamaño: <?php echo SERVICIO_AN2." x ".SERVICIO_AL2;?>
                <?php	if($vFoto4!=""){?>
                <br />
                <a href="<?php echo $vRuta.$vFoto4;?>" title="Ver imagen" target="_blank">Ver imagen actual</a>
                <?php	}?>
                </td>
  	      	</tr>
    	    <tr>
    	      <td colspan="2">
              <h4>Contenido</h4>
            </td>
          </tr>
    	    <tr>
    	      <td colspan="2">
              <textarea rows="10" style="width:100%;" name="txtContenido" id="txtContenido" maxlength="730" class="textarea req" alt="contenido" cols="8"><?php echo $vContenido;?></textarea>
            </td>
          </tr>
    	    <tr>
    	      <td>
              <h4>Beneficios</h4>
            </td>
    	      <td>
              <h4>Elección</h4>
            </td>
          </tr>
    	    <tr>
    	      <td>
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
									"height" => 120,
									"toolbar" => $pVar,
									"skin" => 'v2'
								);
echo $oFCKeditor[0]->editor('txtBeneficios', $vBeneficios);
unset($oFCKeditor[0]);
		?><br /><br /><br />
            </td>
    	      <td>
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
									"height" => 120,
									"toolbar" => $pVar,
									"skin" => 'v2'
								);
echo $oFCKeditor[0]->editor('txtEleccion', $vEleccion);
unset($oFCKeditor[0]);
		?><br /><br /><br />
            </td>
          </tr>
    	    <tr>
    	      <td colspan="2" align="right" class="barra">
              	<input type="button" onclick="javascript:location.href='servicio.php?tipo=<?php echo $vIdTipo;?>&pag=<?php echo $vIntPagAct;?>';" name="button" id="button" value="VOLVER" class="cancelar" />
                &nbsp;&nbsp;&nbsp;
              	<input type="submit" name="button" id="button" value="ACEPTAR" class="guardar" />
              </td>
    	      </tr>
  	    </table>
        </form>
    	</div>
<?php include("ifoo.php");?>