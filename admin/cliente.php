<?php 
include("../libs/fb_xin.php");
include("../libs/fb_xam.php");
include("../libs/vi/Cliente.php");
$vMenu=5;
?>
<?php include("ihea.php");?>
		<div class="h2">CLIENTES
            <div class="bot">
              <a href="cliente-reg.php?acc=2" title="CREAR NUEVO" class="nu">CREAR NUEVO</a>
          	</div>
        </div>
    	<div class="edit">
<?php	if(is_array($listado)){?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="lst">
  <tr>
    <th >N°</th>
    <th width="30%">IMAGEN</th>
    <th width="50%">TITULO</th>
    <th width="10%">ESTADO</th>
    <th>POSICIÓN</th>
    <th align="center" colspan="2" style="text-align:center;"></th>
  </tr>
<?php		foreach($listado as $li){$vIntNumIni++;?>
  <tr>
    <td><?php echo $vIntNumIni;?></td>
    <td><img src="<?php echo $vRuta.$li->foto;?>" width="50%" title="Foto" /></td>
    <td><?php echo $li->titulo;?></td>
    <td align="center"><?php if($li->estado==1) echo 'Publicado'; else echo 'No publicado';?></td>
    <td align="center">
<?php	if($li->orden>1){?>
		<a href="cliente.php?acc=5&ord=<?php echo ($li->orden-1)?>&amp;item=<?php echo $li->id_cliente?>" title="ARRIBA"><img src="im/up.png" border="0" alt="ARRIBA" /></a>
<?php	}
		if($li->orden<$vMax){?>
		<a href="cliente.php?acc=5&ord=<?php echo ($li->orden+1)?>&amp;item=<?php echo $li->id_cliente?>" title="ABAJO"><img src="im/down.png" border="0" alt="ABAJO" /></a>
<?php	}?>
    </td>
    <td align="center"><a onclick='return pregunta1();' href="cliente.php?acc=4&item=<?php echo $li->id_cliente;?>&pag=<?php echo $vIntPagAct;?>" title="ELIMINAR"><img src="im/btn-borrar.jpg" width="19" height="19" border="0" alt="Quitar" /></a></td>
    <td align="center"><a href="cliente-reg.php?acc=2&item=<?php echo $li->id_cliente;?>&pag=<?php echo $vIntPagAct;?>" title="MODIFICAR" class="lnk_azul">MODIFICAR</a></td>
  </tr>
<?php		}?>
</table>
        <div class="paginado">
        	<div class="container">
<?php		echo paginar_web('cliente.php',$vIntPagAct,$vIntNumPag,5);?>
            </div>
        </div>
<?php	}else{?>
			<strong>No hay elementos que mostrar</strong>
<?php	}?>
        </div>
<?php include("ifoo.php");?>