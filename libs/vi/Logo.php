<?php
switch ($acc)
{	//LISTADO
	case 1:
		$obj=new Logo('');
		$listado=$obj->listar($vIntPagAct,10);
		$vIntNumPag=$obj->getTotalPaginas();
		$vIntNumReg=$obj->getTotalRegistros();
		$vIntNumIni=$obj->getInicial($vIntPagAct);
		$vMax=$obj->mostrarMaxOrden();
		unset($obj);
		$vRuta='../'.OBJ_LOGO;
		break;
	//MODIFICAR
	case 2:
		if((isset($_GET['item']))&&($_GET['item']!=""))
			$vId=formatear_numeros($_GET['item']);
		else
			$vId="";
		
		$vFoto	="";
		
		if((is_numeric($vId))&&($vId!="0"))
		{	$obj=new Logo($vId);
			$vId=$obj->id_logo;
			$vFoto=$obj->foto;
			$vRuta='../'.OBJ_LOGO;
		}
		break;
	//GUARDAR
	case 3:
		if((isset($_POST['txtId']))&&($_POST['txtId']!="0"))
		{	$vId=formatear_numeros($_POST['txtId']);
			if(!is_numeric($vId))
				$vId="";
		}
		else
			$vId="";
		
		$oThum[0]=new Thumb($_FILES['txtImg11']['name'],$_FILES['txtImg11']['size'],$_FILES['txtImg11']['tmp_name'],0);
		$oThum[0]->valPesoMax=1800000;
		$oThum[0]->valFormMax="JPG,JPEG,GIF,PNG";
		$oThum[0]->tinNombre=0;
		if(isset($_POST['txtImg13']))
			$oThum[0]->tinQuitarImg=formatear_cadena_simple($_POST['txtImg13']);
		$oThum[0]->valDefecto=formatear_cadena_simple($_POST['txtImg12']);
		$oThum[0]->validarObjeto("img_".date("d").date("m").date("Y").date("H").date("i").date("s"));
		
		$arrInput[0]=$oThum[0]->arrObjetos[5];
		
		if(($vId!="")&&($vId!="0")&&(is_numeric($vId))){
			$obj=new Logo($vId);
			$obj->modificar($arrInput);
			$vRes=2;
		}else{
			$obj=new Logo('');
			$vId=$obj->guardar($arrInput);
			$vRes=1;
		}
		
		$vStrRuta="../".OBJ_LOGO;
		$oThum[0]->cargarImagen("",$vStrRuta,"2",LOGO_AN,LOGO_AL);

		linkearUrl("logo.php?msg=".$vRes."&pag=".$vIntPagAct,1);
		die();
		break;
	//ELIMINAR
	case 4:
		if((isset($_GET['item']))&&($_GET['item']!=""))
			$vId=formatear_numeros($_GET['item']);
		else
			linkearUrl("logo.php?msg=6",1);
			
		if(($vId!="")&&($vId!="0")&&(is_numeric($vId)))
		{	$obj=new Logo($vId);
			$obj->eliminar();
			if($obj->foto!=""){
				borrarArchivo("../".OBJ_LOGO.$obj->foto);
			}
			
			linkearUrl("logo.php?msg=3&pag=".$vIntPagAct,1);
			exit(0);
		}
		else
		{	linkearUrl("logo.php?msg=6",1);
			exit(0);
		}
		break;
	//ORDENAR
	case 5:
		if((isset($_GET['item']))&&($_GET['item']!=""))
			$vId=formatear_numeros($_GET['item']);
		else
			linkearUrl("logo.php?msg=6",1);
		if((isset($_GET['ord']))&&($_GET['ord']!=""))
			$vIntOrden=formatear_numeros(trim($_GET['ord']));
		else
			linkearUrl("logo.php?msg=6",1);
			
		if(($vId!="")&&($vId!="0")&&(is_numeric($vId)))
		{	$obj=new Logo($vId);
			$obj->ordenar($vIntOrden);
			linkearUrl("logo.php?msg=4&pag=".$vIntPagAct,1);
			exit(0);
		}
		else
			linkearUrl("logo.php?msg=6",1);
		break;
}
?>