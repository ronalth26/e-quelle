<?php 
include("ckeditor/ckeditor.php");
include("../libs/fb_xin.php");
include("../libs/fb_xam.php");
include("../libs/vi/Servicio.php");
$vMenu=6;
?>
<?php include("ihea.php");?>
		<div class="h2">SERVICIOS
          <div class="bot">
              <a href="servicio-reg.php?acc=2&tipo=<?php echo $vIdTipo;?>" title="CREAR NUEVO" class="nu">CREAR NUEVO</a>
       	  </div>
        </div>
    	<div class="edit">
<form name="listado" id="listado" method="get" action="servicio.php">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tbus">
		<tr>
			<td width="10%"><strong>Categoría</strong></td>
			<td width="90%">
<?php	if(is_array($arrtipos)){?>
			<select name="tipo" id="tipo" class="select" style="width:90%" onChange="javascript:submit();">
<?php		foreach($arrtipos as $tipo){?>
				<option value="<?php echo $tipo->id_tipo;?>" <?php if($vIdTipo==$tipo->id_tipo) echo 'selected="selected"';?>><?php echo $tipo->nombre;?></option>
<?php		}?>
			</select>
<?php	}?>
			</td>
		</tr>
	</table>
</form>
<?php	if(is_array($listado)){?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="lst">
  <tr>
    <th >N°</th>
    <th>FOTO</th>
    <th width="80%">SERVICIO</th>
    <th>ESTADO</th>
    <th>POSICIÓN</th>
    <th colspan="2" align="center"></th>
  </tr>
<?php		foreach($listado as $li){$vIntNumIni++;?>
  <tr>
    <td><?php echo $vIntNumIni;?></td>
    <td><?php if($li->foto1!=""){?><img src="<?php echo $vRuta.$li->id_servicio."/".$li->foto1;?>" width="150" title="<?php echo $li->titulo;?>" /><?php }?></td>
    <td><?php echo $li->titulo;?></td>
    <td align="center"><?php if($li->estado==1) echo 'Publicado'; else echo 'No publicado';?></td>
    <td align="center">
<?php	if($li->orden>1){?>
		<a href="servicio.php?acc=5&ord=<?php echo ($li->orden-1)?>&amp;item=<?php echo $li->id_servicio?>&pag=<?php echo $vIntPagAct;?>" title="ARRIBA"><img src="im/up.png" border="0" alt="ARRIBA" /></a>
<?php	}
		if($li->orden<$vMax){?>
		<a href="servicio.php?acc=5&ord=<?php echo ($li->orden+1)?>&amp;item=<?php echo $li->id_servicio?>&pag=<?php echo $vIntPagAct;?>" title="ABAJO"><img src="im/down.png" border="0" alt="ABAJO" /></a>
<?php	}?>
    </td>
    <td align="center"><a onclick='return pregunta1();' href="servicio.php?acc=4&item=<?php echo $li->id_servicio;?>&pag=<?php echo $vIntPagAct;?>" title="ELIMINAR"><img src="im/btn-borrar.jpg" width="19" height="19" border="0" alt="Quitar" /></a></td>
    <td align="center"><a href="servicio-reg.php?acc=2&item=<?php echo $li->id_servicio;?>&pag=<?php echo $vIntPagAct;?>" title="MODIFICAR" class="lnk_azul">MODIFICAR</a></td>
  </tr>
<?php		}?>
</table>
        <div class="paginado">
        	<div class="container">
<?php		echo paginar_web('servicio.php?tipo='.$vIdTipo,$vIntPagAct,$vIntNumPag,5);?>
            </div>
        </div>
<?php	}else{?>
			<strong>No hay elementos que mostrar</strong>
<?php	}?>
        </div>
<?php include("ifoo.php");?>