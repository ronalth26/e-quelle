<?php
switch($acc){
	case 1: //Listado
			$obj=new Noticia('');
			$listado=$obj->listar('1','',$vIntPagAct,12);
			$vIntNumPag=$obj->getTotalPaginas();
			$vIntNumReg=$obj->getTotalRegistros();
			$vIntNumIni=$obj->getInicial($vIntPagAct);
			unset($obj);
			$vRutaNoticia=HTTP_DIR.OBJ_NOTICIA;
			break;
	case 2: //Detalle
			if((isset($_GET['item']))&&($_GET['item']!=""))
				$vIdItem=formatear_numeros($_GET['item']);
			elseif((isset($_POST['item']))&&($_POST['item']!=""))
				$vIdItem=formatear_numeros($_POST['item']);
			else
				$vIdItem="";

			if($vIdItem=="")
				linkearUrl("noticias.php",1);
			
			$obj=new Noticia($vIdItem);
			$vIdNoticia		=$obj->id_noticia;
			$vFoto			=$obj->foto;
			$vFecha			=fecha_normal($obj->fecha);
			$vTitulo		=$obj->titulo;
			$vResumen		=$obj->resumen;
			$vContenido		=$obj->contenido;
			$vRutaNoticia=HTTP_DIR.OBJ_NOTICIA;
			unset($obj);
		
			$vSeoTitulo=$vTitulo;
			$vSocialDes=cortar_txt($vResumen,190);
			$vSocialUrls=HTTP_DIR."noticia-detalle.php?item=".$vIdNoticia;
			$vSocialImg=$vRutaNoticia.$vFoto;
			$vSocialUrl=1;
			break;	
}
?>