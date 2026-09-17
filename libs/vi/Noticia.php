<?php
switch ($acc){
	//LISTADO
	case 1:
		$obj=new Noticia('');
		$listado=$obj->listar('','',$vIntPagAct,8);
		$vIntNumPag=$obj->getTotalPaginas();
		$vIntNumReg=$obj->getTotalRegistros();
		$vIntNumIni=$obj->getInicial($vIntPagAct);
		$vMax=$obj->mostrarMaxOrden();
		unset($obj);
		$vRuta='../'.OBJ_NOTICIA;
		break;
	//MODIFICAR
	case 2:
		if((isset($_GET['item']))&&($_GET['item']!=""))
			$vIntIdNoticia=formatear_numeros($_GET['item']);
		else
			$vIntIdNoticia="";
		
		if((is_numeric($vIntIdNoticia))&&($vIntIdNoticia!="0"))
		{	$obj=new Noticia($vIntIdNoticia);
			$vIntIdNoticia	=$obj->id_noticia;
			$vFoto			=$obj->foto;
			$vFecha			=fecha_normal($obj->fecha);
			$vTitulo		=$obj->titulo;
			$vResumen		=$obj->resumen;
			$vContenido		=$obj->contenido;
			$vResaltado		=$obj->resaltado;
			$vEstado		=$obj->estado;
			$vRuta='../'.OBJ_NOTICIA;
		}else{
			$vFoto="";
			$vFecha=date("d/m/Y");
			$vTitulo="";
			$vResumen="";
			$vContenido="";
			$vResaltado="0";
			$vEstado="1";
		}
		break;
	//GUARDAR
	case 3:
		if((isset($_POST['txtId']))&&($_POST['txtId']!="0")){
			$vIntIdNoticia=formatear_numeros($_POST['txtId']);
			if(!is_numeric($vIntIdNoticia))
				$vIntIdNoticia="";
		}else
			$vIntIdNoticia="";
		
		$oThum[0]=new Thumb($_FILES['txtImg11']['name'],$_FILES['txtImg11']['size'],$_FILES['txtImg11']['tmp_name'],0);
		$oThum[0]->valPesoMax=1800000;
		$oThum[0]->valFormMax="JPG,JPEG,GIF,PNG";
		$oThum[0]->tinNombre=0;
		if(isset($_POST['txtImg13']))
			$oThum[0]->tinQuitarImg=formatear_cadena_simple($_POST['txtImg13']);
		$oThum[0]->valDefecto=formatear_cadena_simple($_POST['txtImg12']);
		$oThum[0]->validarObjeto("img1_".date("d").date("m").date("Y").date("H").date("i").date("s"));

		$arrInput[0]=$oThum[0]->arrObjetos[5];
		$arrInput[1]=fecha_mysql($_POST['txtFecha']);
		$arrInput[2]=formatear_cadena($_POST['txtTitulo']);
		$arrInput[3]=formatear_cadena($_POST['txtResumen']);
		$arrInput[4]=formatear_cadena_simple($_POST['txtContenido']);
		$arrInput[5]=formatear_numeros($_POST['radResaltado']);
		$arrInput[6]=formatear_numeros($_POST['radEstado']);

		if(($vIntIdNoticia!="")&&($vIntIdNoticia!="0")&&(is_numeric($vIntIdNoticia))){
			$obj=new Noticia($vIntIdNoticia);
			$obj->modificar($arrInput);
			$vRes=2;
		}else{
			$obj=new Noticia('');
			$vIntIdNoticia=$obj->guardar($arrInput);
			$vRes=1;
		}
		
		$vStrRuta="../".OBJ_NOTICIA;
		$oThum[0]->cargarImagen("",$vStrRuta,"2",NOTICIA_AN1,NOTICIA_AL1);
		
		linkearUrl("noticia.php?msg=".$vRes."&pag=".$vIntPagAct,1);
		die();
		break;
	//ELIMINAR
	case 4:
		if((isset($_GET['item']))&&($_GET['item']!=""))
			$vIntIdNoticia=formatear_numeros($_GET['item']);
		else
			linkearUrl("noticia.php?msg=6",1);
			
		if(($vIntIdNoticia!="")&&($vIntIdNoticia!="0")&&(is_numeric($vIntIdNoticia))){
			$obj=new Noticia($vIntIdNoticia);
			$obj->eliminar();
			if($obj->foto!="")
				borrarArchivo("../".OBJ_NOTICIA.$obj->foto);
			unset($obj);

			linkearUrl("noticia.php?msg=3&pag=".$vIntPagAct,1);
			exit(0);
		}else{
			linkearUrl("noticia.php?msg=6",1);
			exit(0);
		}
		break;
	//ORDENAR
	case 5:
		if((isset($_GET['item']))&&($_GET['item']!=""))
			$vIntIdNoticia=formatear_numeros($_GET['item']);
		else
			linkearUrl("noticia.php?msg=6",1);
		if((isset($_GET['ord']))&&($_GET['ord']!=""))
			$vIntOrden=formatear_numeros(trim($_GET['ord']));
		else
			linkearUrl("noticia.php?msg=6",1);
			
		if(($vIntIdNoticia!="")&&($vIntIdNoticia!="0")&&(is_numeric($vIntIdNoticia)))
		{	$obj=new Noticia($vIntIdNoticia);
			$obj->ordenar($vIntOrden);
			header("location:noticia.php?msg=4&pag=".$vIntPagAct);
			exit(0);
		}
		else
			linkearUrl("noticia.php?msg=6",1);
		break;
}
?>