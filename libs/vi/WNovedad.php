<?php
switch($acc){
	case 1: //Listado
			$obj=new Novedad('');
			$listado=$obj->listar($vIntPagAct,8);
			$vIntNumPag=$obj->getTotalPaginas();
			$vIntNumReg=$obj->getTotalRegistros();
			$vIntNumIni=$obj->getInicial($vIntPagAct);
			unset($obj);
			$vRutaNov=HTTP_DIR.OBJ_NOVEDAD;
			break;
	case 2: //Detalle
			if((isset($_GET['item']))&&($_GET['item']!=""))
				$vIdItem=formatear_numeros($_GET['item']);
			elseif((isset($_POST['item']))&&($_POST['item']!=""))
				$vIdItem=formatear_numeros($_POST['item']);
			else
				$vIdItem="";

			if($vIdItem=="")
				linkearUrl("novedades.php",1);
			
			$obj=new Novedad($vIdItem);
			$vIdNovedad=$obj->id_novedad;
			$vFecha=fecha_normal($obj->fecha);
			$vFoto1=$obj->foto1;
			$vFoto2=$obj->foto2;
			$vArchivo=$obj->archivo;
			$vTitulo=$obj->titulo;
			$vResumen=$obj->resumen;
			$vContenido=$obj->contenido;
			$vRutaNov=HTTP_DIR.OBJ_NOVEDAD;
			unset($obj);
		
			$vSeoTitulo=$vTitulo;
			$vSocialDes=cortar_txt($vResumen,190);
			$vSocialUrls=HTTP_DIR."novedad.php?item=".$vIdNovedad;
			$vSocialImg=$vRutaNov.$vFoto1;
			$vSocialUrl=1;
			break;	
}
?>