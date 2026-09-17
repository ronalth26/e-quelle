<?php
switch($acc){
	case 1: //Marcas
			$obj= new Marca('');
			$listado=$obj->listar($vTipo,$vIntPagAct,12);
			$vIntNumPag=$obj->getTotalPaginas();
			$vIntNumReg=$obj->getTotalRegistros();
			$vIntNumIni=$obj->getInicial($vIntPagAct);
			unset($obj);
			$vRutaProd=HTTP_DIR.OBJ_PRODUCTO;
			break;
	case 2: //Productos
			if((isset($_GET['marca']))&&($_GET['marca']!=""))
				$vIdMarca=formatear_numeros($_GET['marca']);
			elseif((isset($_POST['marca']))&&($_POST['marca']!=""))
				$vIdMarca=formatear_numeros($_POST['marca']);
			else
				$vIdMarca="";
		
			if((isset($_GET['tipo1']))&&($_GET['tipo1']!=""))
				$vTipo1=formatear_numeros($_GET['tipo1']);
			elseif((isset($_POST['tipo1']))&&($_POST['tipo1']!=""))
				$vTipo1=formatear_numeros($_POST['tipo1']);
			else
				$vTipo1="";
		
			if((isset($_GET['tipo2']))&&($_GET['tipo2']!=""))
				$vTipo2=formatear_numeros($_GET['tipo2']);
			elseif((isset($_POST['tipo2']))&&($_POST['tipo2']!=""))
				$vTipo2=formatear_numeros($_POST['tipo2']);
			else
				$vTipo2="";
		
			$vParametros="marca=".$vIdMarca;
			if($vTipo1!="")
				$vParametros.="&tipo1=".$vTipo1;
			if($vTipo2!="")
				$vParametros.="&tipo2=".$vTipo2;
			
			if($vIdMarca=="")
				linkearUrl("productos-home.php",1);
			else{
				$oMarca=new Marca($vIdMarca);
				$vTipo=$oMarca->tipo;
				$vMarca=$oMarca->nombre;
				unset($oMarca);
			}

			$obj=new Producto('');
			$listado=$obj->listar($vTipo,$vIdMarca,$vTipo1,$vTipo2,'1',$vIntPagAct,16);
			$vIntNumPag=$obj->getTotalPaginas();
			$vIntNumReg=$obj->getTotalRegistros();
			$vIntNumIni=$obj->getInicial($vIntPagAct);
			unset($obj);
			$vRutaProd=HTTP_DIR.OBJ_PRODUCTO.$vIdMarca."/";
			break;
	case 3: //Producto
			if((isset($_GET['item']))&&($_GET['item']!=""))
				$vIdProducto=formatear_numeros($_GET['item']);
			elseif((isset($_POST['item']))&&($_POST['item']!=""))
				$vIdProducto=formatear_numeros($_POST['item']);
			else
				$vIdProducto="";
		
			if($vIdProducto=="")
				linkearUrl("productos-home.php",1);
			
			$obj=new Producto($vIdProducto);
			$vIdProducto=$obj->id_producto;
			$vIdMarca=$obj->id_marca;
			$vTipo=$obj->tipo;
			$vTipo1=$obj->tipo1;
			$vTipo2=$obj->tipo2;
			$vFecha=fecha_normal($obj->fecha);
			$vFoto1=$obj->foto1;
			$vFoto2=$obj->foto2;
			$vFoto3=$obj->foto3;
			$vFoto4=$obj->foto4;
			$vFoto5=$obj->foto5;
			$vVideo=$obj->video;
			$vArchivo=$obj->archivo;
			$vTitulo=$obj->titulo;
			$vContenido=$obj->contenido;
			$vFotoBeneficio=$obj->foto_beneficio;
			$vFotoIngrediente=$obj->foto_ingrediente;
		 	$vTextoIngrediente=$obj->texto_ingrediente;
		 	$vEstado=$obj->estado;
			unset($obj);
		
			
			$obj=new ProductoMedida('');
			$listado=$obj->listar($vIdProducto);
			unset($obj);
		
			$vRutaProd=HTTP_DIR.OBJ_PRODUCTO.$vIdMarca."/".$vIdProducto."/";
		
			$vSeoTitulo=$vTitulo;
			$vSocialDes=cortar_txt($vContenido,190);
			$vSocialUrls=HTTP_DIR."producto.php?item=".$vIdProducto;
			$vSocialImg=$vRutaProd.$vFoto1;
			$vSocialUrl=1;
			break;
}
?>