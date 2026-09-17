<?php
switch ($acc)
{	//LISTADO
	case 1:
		if((isset($_GET['tipo']))&&($_GET['tipo']!=""))
			$vIdTipo=formatear_numeros($_GET['tipo']);
		else
			$vIdTipo="";
		
		$oTipo=new ServicioTipo('');
		$arrtipos=$oTipo->listar();
		unset($oTipo);
		
		if($vIdTipo==''){
			if(is_array($arrtipos))
				$vIdTipo=$arrtipos[0]->id_tipo;
		}
		
		$obj=new Servicio('');
		$listado=$obj->listar($vIdTipo,'',$vIntPagAct,8);
		$vIntNumPag=$obj->getTotalPaginas();
		$vIntNumReg=$obj->getTotalRegistros();
		$vIntNumIni=$obj->getInicial($vIntPagAct);
		$vMax=$obj->mostrarMaxOrden($vIdTipo);
		unset($obj);
		$vRuta='../'.OBJ_SERVICIO;
		break;
	//MODIFICAR
	case 2:
		if((isset($_GET['item']))&&($_GET['item']!=""))
			$vIdServicio=formatear_numeros($_GET['item']);
		else
			$vIdServicio="";
		$vIdTipo='';
		
		if((is_numeric($vIdServicio))&&($vIdServicio!="0"))
		{	$obj=new Servicio($vIdServicio);
			$vIdServicio	=$obj->id_servicio;
		 	$vIdTipo		=$obj->id_tipo;
			$vFoto1			=$obj->foto1;
			$vFoto2			=$obj->foto2;
			$vFoto3			=$obj->foto3;
			$vFoto4			=$obj->foto4;
			$vTitulo		=$obj->titulo;
			$vResumen		=$obj->resumen;
			$vContenido		=$obj->contenido;
			$vBeneficios 	=$obj->beneficios;
			$vEleccion 		=$obj->eleccion;
		 	$vEstado		=$obj->estado;
			$vRuta='../'.OBJ_SERVICIO.$vIdServicio."/";
		}else{
			if((isset($_GET['tipo']))&&($_GET['tipo']!="")){
				$vIdTipo=formatear_numeros($_GET['tipo']);
			}
			else
				linkearUrl("servicio.php?msg=6",1);
			$vFoto1		="";
			$vFoto2		="";
			$vFoto3		="";
			$vFoto4		="";
			$vTitulo	="";
			$vResumen	="";
			$vContenido	="";
			$vBeneficios="";
			$vEleccion 	="";
			$vEstado	="1";
		}
		$otipo=new ServicioTipo($vIdTipo);
		$vStrNombretipo=$otipo->nombre;
		unset($otipo);
		break;
	//GUARDAR
	case 3:
		if((isset($_POST['txtId']))&&($_POST['txtId']!="0")){
			$vIdServicio=formatear_numeros($_POST['txtId']);
			if(!is_numeric($vIdServicio))
				$vIdServicio="";
		}else
			$vIdServicio="";
		
		$oThum[0]=new Thumb($_FILES['txtImg11']['name'],$_FILES['txtImg11']['size'],$_FILES['txtImg11']['tmp_name'],0);
		$oThum[0]->valPesoMax=1800000;
		$oThum[0]->valFormMax="JPG,JPEG,GIF,PNG";
		$oThum[0]->tinNombre=0;
		if(isset($_POST['txtImg13']))
			$oThum[0]->tinQuitarImg=formatear_cadena_simple($_POST['txtImg13']);
		$oThum[0]->valDefecto=formatear_cadena_simple($_POST['txtImg12']);
		$oThum[0]->validarObjeto("img1_".date("d").date("m").date("Y").date("H").date("i").date("s"));
		
		$oThum[1]=new Thumb($_FILES['txtImg21']['name'],$_FILES['txtImg21']['size'],$_FILES['txtImg21']['tmp_name'],0);
		$oThum[1]->valPesoMax=1900000;
		$oThum[1]->valFormMax="JPG,JPEG,GIF,PNG";
		$oThum[1]->tinNombre=0;
		if(isset($_POST['txtImg23']))
			$oThum[1]->tinQuitarImg=formatear_cadena_simple($_POST['txtImg23']);
		$oThum[1]->valDefecto=formatear_cadena_simple($_POST['txtImg22']);
		$oThum[1]->validarObjeto("img2_".date("d").date("m").date("Y").date("H").date("i").date("s"));
		
		$oThum[2]=new Thumb($_FILES['txtImg31']['name'],$_FILES['txtImg31']['size'],$_FILES['txtImg31']['tmp_name'],0);
		$oThum[2]->valPesoMax=1900000;
		$oThum[2]->valFormMax="JPG,JPEG,GIF,PNG";
		$oThum[2]->tinNombre=0;
		if(isset($_POST['txtImg33']))
			$oThum[2]->tinQuitarImg=formatear_cadena_simple($_POST['txtImg33']);
		$oThum[2]->valDefecto=formatear_cadena_simple($_POST['txtImg32']);
		$oThum[2]->validarObjeto("img3_".date("d").date("m").date("Y").date("H").date("i").date("s"));
		
		$oThum[3]=new Thumb($_FILES['txtImg41']['name'],$_FILES['txtImg41']['size'],$_FILES['txtImg41']['tmp_name'],0);
		$oThum[3]->valPesoMax=1900000;
		$oThum[3]->valFormMax="JPG,JPEG,GIF,PNG";
		$oThum[3]->tinNombre=0;
		if(isset($_POST['txtImg43']))
			$oThum[3]->tinQuitarImg=formatear_cadena_simple($_POST['txtImg43']);
		$oThum[3]->valDefecto=formatear_cadena_simple($_POST['txtImg42']);
		$oThum[3]->validarObjeto("img4_".date("d").date("m").date("Y").date("H").date("i").date("s"));
		
		$vIdTipo=formatear_numeros($_POST['tipo']);
		
		$arrInput[0]=$vIdTipo;
		$arrInput[1]=$oThum[0]->arrObjetos[5];
		$arrInput[2]=$oThum[1]->arrObjetos[5];
		$arrInput[3]=$oThum[2]->arrObjetos[5];
		$arrInput[4]=$oThum[3]->arrObjetos[5];
		$arrInput[5]=formatear_cadena($_POST['txtTitulo']);
		$arrInput[6]=formatear_cadena($_POST['txtResumen']);
		$arrInput[7]=formatear_cadena_simple($_POST['txtContenido']);
		$arrInput[8]=formatear_cadena_simple($_POST['txtBeneficios']);
		$arrInput[9]=formatear_cadena_simple($_POST['txtEleccion']);
		$arrInput[10]=formatear_numeros($_POST['radEstado']);
		
		if(($vIdServicio!="")&&($vIdServicio!="0")&&(is_numeric($vIdServicio))){
			$obj=new Servicio($vIdServicio);
			$obj->modificar($arrInput);
			$vRes=2;
		}else{
			$obj=new Servicio('');
			$vIdServicio=$obj->guardar($arrInput);
			$vRes=1;
		}
		
		$vStrRuta="../".OBJ_SERVICIO.$vIdServicio."/";
		crearCarpeta($vStrRuta);
		crearCarpeta($vStrRuta."gr/");
		$oThum[0]->cargarImagen("",$vStrRuta,"2",SERVICIO_AN1,SERVICIO_AL1);
		$oThum[0]->cargarImagen("",$vStrRuta."gr/","2",SERVICIO_AN2,SERVICIO_AL2);
		$oThum[1]->cargarImagen("",$vStrRuta,"2",SERVICIO_AN1,SERVICIO_AL1);
		$oThum[1]->cargarImagen("",$vStrRuta."gr/","2",SERVICIO_AN2,SERVICIO_AL2);
		$oThum[2]->cargarImagen("",$vStrRuta,"2",SERVICIO_AN1,SERVICIO_AL1);
		$oThum[2]->cargarImagen("",$vStrRuta."gr/","2",SERVICIO_AN2,SERVICIO_AL2);
		$oThum[3]->cargarImagen("",$vStrRuta,"2",SERVICIO_AN1,SERVICIO_AL1);
		$oThum[3]->cargarImagen("",$vStrRuta."gr/","2",SERVICIO_AN2,SERVICIO_AL2);
		
		linkearUrl("servicio.php?tipo=".$vIdTipo."&msg=".$vRes."&pag=".$vIntPagAct,1);
		die();
		break;
	//ELIMINAR
	case 4:
		if((isset($_GET['item']))&&($_GET['item']!=""))
			$vId=formatear_numeros($_GET['item']);
		else
			linkearUrl("servicio.php?msg=6",1);
			
		if(($vId!="")&&($vId!="0")&&(is_numeric($vId)))
		{	$obj=new Servicio($vId);
			$obj->eliminar();
			$vStrRuta="../".OBJ_SERVICIO.$vId."/";
			borrarCarpeta($vStrRuta);
			
			linkearUrl("servicio.php?tipo=".$obj->id_tipo."&msg=3&pag=".$vIntPagAct,1);
			unset($obj);
			exit(0);
		}
		else
		{	linkearUrl("servicio.php?msg=6",1);
			exit(0);
		}
		break;
	//ORDENAR
	case 5:
		if((isset($_GET['item']))&&($_GET['item']!=""))
			$vId=formatear_numeros($_GET['item']);
		else
			linkearUrl("servicio.php?msg=6",1);
		if((isset($_GET['ord']))&&($_GET['ord']!=""))
			$vIntOrden=formatear_numeros(trim($_GET['ord']));
		else
			linkearUrl("servicio.php?msg=6",1);
			
		if(($vId!="")&&($vId!="0")&&(is_numeric($vId)))
		{	$obj=new Servicio($vId);
			$obj->ordenar($vIntOrden);
			header("location:servicio.php?tipo=".$obj->id_tipo."&msg=4&pag=".$vIntPagAct);
			unset($obj);
			exit(0);
		}
		else
			linkearUrl("servicio.php?msg=6",1);
		break;
}
?>