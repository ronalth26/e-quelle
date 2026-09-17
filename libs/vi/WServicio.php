<?php
switch($acc){
	case 1: //Lista
			$vVistaServicio=0;
			if((isset($_GET['tipo']))&&($_GET['tipo']!=""))
				$vIdTipo=formatear_numeros($_GET['tipo']);
			elseif((isset($_POST['tipo']))&&($_POST['tipo']!=""))
				$vIdTipo=formatear_numeros($_POST['tipo']);
			elseif((isset($_GET['tipo-servicio']))&&($_GET['tipo-servicio']!="")){
				$vVistaServicio=1;
				$vIdTipo=formatear_numeros($_GET['tipo-servicio']);
			}elseif((isset($_POST['tipo-servicio']))&&($_POST['tipo-servicio']!="")){
				$vVistaServicio=1;
				$vIdTipo=formatear_numeros($_POST['tipo-servicio']);
			}
			else
				$vIdTipo="1";
		
			$oTipo=new ServicioTipo('');
			$arrtipos=$oTipo->listar();
			unset($oTipo);

			$obj=new Servicio('');
			$servicios=$obj->listar($vIdTipo,'1',$vIntPagAct,12);
			$vIntNumPag=$obj->getTotalPaginas();
			$vIntNumReg=$obj->getTotalRegistros();
			$vIntNumIni=$obj->getInicial($vIntPagAct);
			unset($obj);
			
			$vRutaServicio=HTTP_DIR.OBJ_SERVICIO;
			break;
	case 2: //Productos
			if((isset($_GET['item']))&&($_GET['item']!=""))
				$vIdServicio=formatear_numeros($_GET['item']);
			elseif((isset($_POST['item']))&&($_POST['item']!=""))
				$vIdServicio=formatear_numeros($_POST['item']);
			else
				$vIdServicio="";
				
			if($vIdServicio=="")
			  linkearUrl("servicio.php",1);
		
			$obj=new Servicio($vIdServicio);
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
			$vRutaServicio	=HTTP_DIR.OBJ_SERVICIO.$vIdServicio."/";
		 	unset($obj);

		
			$vSeoTitulo=$vTitulo;
			$vSocialDes=cortar_txt($vResumen,190);
			$vSocialUrls=HTTP_DIR."servicio-detalle.php?item=".$vIdServicio;
			$vSocialImg=$vRutaServicio.$vFoto1;
			$vSocialUrl=1;
			break;
	case 3://Enviando Correo
		if((isset($_GET['item']))&&($_GET['item']!=""))
			$vIdServicio=formatear_numeros($_GET['item']);
		elseif((isset($_POST['item']))&&($_POST['item']!=""))
			$vIdServicio=formatear_numeros($_POST['item']);
		else
			$vIdServicio="";

		if($vIdServicio=="")
		  die("error");
		$vNombres=formatear_cadena($_POST['nombre']);
		$vCorreo=formatear_cadena_simple($_POST['correo']);
		$vComentarios=formatear_cadena_simple($_POST['comentario']);
		//preview($_POST,1);
		if(($vNombres!="")&&($vCorreo!="")&&($vComentarios!="")){
			
			$oServicio=new Servicio($vIdServicio);
			$vIdTipo=$oServicio->id_cate;
			$vServicio=$oServicio->titulo;
			unset($oServicio);
			
			$arrInput[0]=$vIdServicio;
			$arrInput[1]=$vIdTipo;
			$arrInput[2]='0';
			$arrInput[3]=date("Y-m-d")." ".date("H:i:s");
			$arrInput[4]=$vNombres;
			$arrInput[5]=$vCorreo;
			$arrInput[6]=$vComentarios;
			$arrInput[7]='2';
			
			$oCom=new Comentario('');
			$oCom->guardar($arrInput);
			unset($oCom);

			$vMail="<strong><em>Comentarios en Servicio</em></strong><br /><br />";
			$vMail.="<strong>Post: </strong>".$vServicio."<br />";
			$vMail.="<strong>Nombres: </strong>".$vNombres."<br />";
			$vMail.="<strong>Dni: </strong>".$vDni."<br />";
			$vMail.="<strong>Teléfono: </strong>".$vTelefono."<br />";
			$vMail.="<strong>Correo Electrónico: </strong>".$vCorreo."<br />";
			$vMail.="<strong>Fecha: </strong>".date("d/m/Y")."<br />";
			$vMail.="<strong>Comentarios: </strong>".nl2br($vComentarios)."<br />";
			$vMail.="<br><br>Atentamente<br>Rintisa<br><br>";

			$vMail=str_replace("[TEXTO]",$vMail,MAIL_CONTENIDO);

			$headers = 'MIME-Version: 1.0' . "\r\n";
			$headers.= "Content-type: text/html;\n Content-Type: image/jpg;\n Content-Transfer-Encoding: base64;\n charset=iso-8859-1\r\n"; 
			$headers.= 'To: Rintisa <'.MAIL_CONTACTO.'>' . "\r\n";
			$headers.= 'From: '.$vNombres.' <'.$vCorreo.'>' . "\r\n";
			mail(MAIL_CONTACTO,"Comentarios en Servicio: ".utf8_decode($vServicio),utf8_decode($vMail),$headers);

			
			$vMail='Estimado (a) '.$vNombres.'<br><br>Hemos recibido sus comentarios en nuestro post: "'.utf8_decode($vServicio).'"; en breve nos contactaremos con usted.<br><br>Muchas gracias por su tiempo.<br><br>Atentamente<br>Rintisa<br><br>*';
			$vMail=str_replace("[TEXTO]",$vMail,MAIL_CONTENIDO);

			$headers = "MIME-Version: 1.0\r\n"; 
			$headers.= "Content-type: text/html;\n Content-Type: image/jpg;\n Content-Transfer-Encoding: base64;\n charset=iso-8859-1\r\n"; 
			$headers.= 'To: '.$vNombres." ".$vApellidos.' <'.$vCorreo.'>' . "\r\n";
			$headers.= "From: Rintisa<".MAIL_CONTACTO.">\r\n";
			mail($vCorreo,utf8_decode("Confirmación de envío"),utf8_decode($vMail),$headers);

			$vRespuesta='<div class="respuesta"><div class="sub"><strong>Sqeqweus comentarios fueron enviados</strong><br><br> Hemos recibido sus comentarios; en breve nos contactaremos con usted.<br><br>';
			$vRespuesta.='<div style="padding:40px auto 50px; text-align:center;"><a href="javascript:cargar_form();" class="boton">Haga clic para continuar</a></div>';
			$vRespuesta.='</div></div>';
			die($vRespuesta);
		}else{
			$vRespuesta='<div class="respuesta"><div class="sub"><strong>Hubowerwer un error</strong><br><br> Por favor, vuelva a intentar enviar sus comentarios.<br><br>';
			$vRespuesta.='<div style="padding:40px auto 50px; text-align:center;"><a href="javascript:cargar_form();" class="boton">Haga clic para continuar</a></div>';
			$vRespuesta.='</div></div>';
			die($vRespuesta);
		}
}
?>