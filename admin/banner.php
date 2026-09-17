<?php 
include("../libs/fb_xin.php");
include("../libs/fb_xam.php");
include("../libs/vi/Banner.php");
$vMenu=2;
?>
<?php include("ihea.php");?>
		<div class="h2">BANNERS</div>
    	<div class="edit">
<?php	if(is_array($listado)){?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="lst">
  <tr>
    <th >N°</th>
    <th width="50%">SLIDER</th>
    <th width="50%">TÍTULO</th>
    <th>POSICIÓN</th>
    <th></th>
  </tr>
<?php		foreach($listado as $li){
          $vIntNumIni++;?>
  <tr>
    <td><?php echo $vIntNumIni;?></td>
    <td>
	    <img src="<?php echo $vRuta.$li->foto;?>" width="80%">
    </td>
    <td>
	    <?php echo $li->titulo;?>
    </td>
    <td align="center">
<?php	if($li->orden>1){?>
		<a href="banner.php?acc=5&ord=<?php echo ($li->orden-1)?>&amp;item=<?php echo $li->id_banner;?>" title="ARRIBA"><img src="im/up.png" border="0" alt="ARRIBA" /></a>
<?php	}
		if($li->orden<$vMax){?>
		<a href="banner.php?acc=5&ord=<?php echo ($li->orden+1)?>&amp;item=<?php echo $li->id_banner;?>" title="ABAJO"><img src="im/down.png" border="0" alt="ABAJO" /></a>
<?php	}?>
    </td>
    <!--<td align="center"><a onclick='return pregunta1();' href="banner.php?acc=4&item=<?php echo $li->id;?>" title="ELIMINAR"><img src="im/btn-borrar.jpg" width="19" height="19" border="0" alt="Quitar" /></a></td>-->
    <td align="center"><a href="banner-reg.php?acc=2&item=<?php echo $li->id_banner;?>" title="MODIFICAR" class="lnk_azul">MODIFICAR</a></td>
  </tr>
<?php		}?>
</table>
        <div class="paginado">
        	<div class="container">
<?php		echo paginar_web('banner.php',$vIntPagAct,$vIntNumPag,5);?>
            </div>
        </div>
<?php	}else{?>
			<strong>No hay elementos que mostrar</strong>
<?php	}?>
        </div>
<?php include("ifoo.php");?>