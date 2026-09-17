<?php
switch ($acc){
	//LISTADO
	case 1:
		$obj=new Banner('');
		$listado=$obj->listar($vIntPagAct,8);
		$vIntNumPag=$obj->getTotalPaginas();
		$vIntNumReg=$obj->getTotalRegistros();
		$vIntNumIni=$obj->getInicial($vIntPagAct);
		$vMax=$obj->mostrarMaxOrden();
		unset($obj);
		$vRuta='../'.OBJ_BANNER;
		break;
	//MODIFICAR
	case 2:
		if((isset($_GET['item']))&&($_GET['item']!=""))
			$vId=formatear_numeros($_GET['item']);
		else
			$vId="";
		
		$vFoto		="";
		$vFotoB		="";
		$vTitulo	="";
		$vSubTitulo	="";
		$vResumen	="";
		$vEnlace	="";

		if((is_numeric($vId))&&($vId!="0")){
			$obj		=new Banner($vId);
			$vId		=$obj->id_banner;
			$vFoto		=$obj->foto;
			$vFotoB		=$obj->fotob;
			$vTitulo	=$obj->titulo;
			$vSubTitulo	=$obj->subtitulo;
			$vResumen	=$obj->resumen;
			$vEnlace	=$obj->enlace;
			$vRuta		='../'.OBJ_BANNER;
		}else{
			linkearUrl("banner.php",1);
		}
		break;
	//GUARDAR
	case 3:
		if((isset($_POST['txtId']))&&($_POST['txtId']!="0"))
		{	$vId=formatear_numeros($_POST['txtId']);
			if(!is_numeric($vId))
				$vId="";
		}else
			$vId="";
	
		$oThum[0]=new Thumb($_FILES['txtImg11']['name'],$_FILES['txtImg11']['size'],$_FILES['txtImg11']['tmp_name'],0);
		$oThum[0]->valPesoMax=1800000;
		$oThum[0]->valFormMax="JPG,JPEG,GIF,PNG";
		$oThum[0]->tinNombre=0;
		if(isset($_POST['txtImg13']))
			$oThum[0]->tinQuitarImg=formatear_cadena_simple($_POST['txtImg13']);
		$oThum[0]->valDefecto=formatear_cadena_simple($_POST['txtImg12']);
		$oThum[0]->validarObjeto("img_".date("d").date("m").date("Y").date("H").date("i").date("s"));
	
		$oThum[1]=new Thumb($_FILES['txtImg21']['name'],$_FILES['txtImg21']['size'],$_FILES['txtImg21']['tmp_name'],0);
		$oThum[1]->valPesoMax=1800000;
		$oThum[1]->valFormMax="JPG,JPEG,GIF,PNG";
		$oThum[1]->tinNombre=0;
		if(isset($_POST['txtImg23']))
			$oThum[1]->tinQuitarImg=formatear_cadena_simple($_POST['txtImg23']);
		$oThum[1]->valDefecto=formatear_cadena_simple($_POST['txtImg22']);
		$oThum[1]->validarObjeto("img_ch_".date("d").date("m").date("Y").date("H").date("i").date("s"));

		$arrInput[0]=$oThum[0]->arrObjetos[5];
		$arrInput[1]=$oThum[1]->arrObjetos[5];
		$arrInput[2]=formatear_cadena($_POST['txtTitulo']);
		$arrInput[3]=formatear_cadena($_POST['txtSubTitulo']);
		$arrInput[4]=formatear_cadena($_POST['txtResumen']);
		$arrInput[5]=formatear_cadena_simple($_POST['txtEnlace']);
		if($arrInput[5]!="")
			if(strstr($arrInput[5],"http")=='')
				$arrInput[5]="http://".$arrInput[5];

		if(($vId!="")&&($vId!="0")&&(is_numeric($vId))){
			$obj=new Banner($vId);
			$obj->modificar($arrInput);
			$vRes=2;
		}
		
		$vStrRuta="../".OBJ_BANNER;
		$oThum[0]->cargarImagen("",$vStrRuta,"2",BANNER_AN1,BANNER_AL1);
		$oThum[1]->cargarImagen("",$vStrRuta,"2",BANNER_AN3,BANNER_AL3);

		linkearUrl("banner.php?msg=".$vRes,1);
		die();
		break;
	//ORDENAR
	case 5:
		if((isset($_GET['item']))&&($_GET['item']!=""))
			$vId=formatear_numeros($_GET['item']);
		else
			linkearUrl("banner.php?msg=6",1);
		if((isset($_GET['ord']))&&($_GET['ord']!=""))
			$vIntOrden=formatear_numeros(trim($_GET['ord']));
		else
			linkearUrl("banner.php?msg=6",1);
			
		if(($vId!="")&&($vId!="0")&&(is_numeric($vId))){
			$obj=new Banner($vId);
			$obj->ordenar($vIntOrden);
			header("location:banner.php?msg=4");
			exit(0);
		}
		else
			linkearUrl("banner.php?msg=6",1);
		break;
}
?>