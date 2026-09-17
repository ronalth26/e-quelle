<?php
switch($acc){
	case 1: //Listado
			$vPaginado=0;
			$obj=new Catalogo('');
			$catalogo=$obj->listar('1');
			unset($obj);
			
			if(is_array($catalogo)){
				$vIdCatalogo=$catalogo[0]->id_catalogo;
				$vCatalogo=$catalogo[0]->nombre;
				$vArchivo=$catalogo[0]->archivo;
				$vRutaCata=HTTP_DIR.OBJ_CATALOGO.$catalogo[0]->id_catalogo."/";
				$vRutaCatalogo=HTTP_DIR.OBJ_CATALOGO;
				
				$oCF=new CatalogoFoto('');
				$fotos=$oCF->listar($vIdCatalogo);
				$vTotalFotos=count($fotos);
				
				if(strstr($vTotalFotos/2,".")!="")
					$vPaginado=explode(".",$vTotalFotos/2)[0];
				else
					$vPaginado=$vTotalFotos/2;
				unset($oCF);
		
				$vSeoTitulo=$vCatalogo;
				$vSocialDes="Revisa nuestro catálogo actualizado";
				$vSocialUrls=HTTP_DIR."catalogo.php";
				$vSocialImg=$vRutaCata.$fotos[0]->foto;
				$vSocialUrl=1;
			}else
				$vRutaCata='';
			break;
}
?>