<?php
switch($acc){
	case 1://
		/*switch($_GET['res']){
			case '1':$vRpta='Su información ha sido prcesada correctamente, en breve nos comunicaremos con usted';	$vTinSalto=1;$vSalto=1400;break;
			case '0':$vRpta='Hubo un problema en el envío. Por favor inténtelo de nuevo'; $vTinSalto=1;break;
		}*/
		break;
	case 2://Enviando Contacto
	
    	// Honeypot: Campo oculto que los bots llenan pero humanos no ven.
    	if(!empty($_POST['honey_pie'])){
			die("Error: Bot detectado.");
		}
		
		if(isset($_POST['nombres']))
			// $vNombres=formatear_cadena($_POST['nombres']);
			$vNombres=sanitizar_input_sql($_POST['nombres']);
		if(isset($_POST['dni']))
			$vDni=formatear_numeros($_POST['dni']);
		if(isset($_POST['telefono']))
			$vTelefono=formatear_numeros($_POST['telefono']);
		if(isset($_POST['correo']))
			// $vCorreo=formatear_cadena_simple($_POST['correo']);
			$vCorreo=sanitizar_input_sql($_POST['correo']);
		if(isset($_POST['contenido']))
			// $vComentarios=formatear_cadena_simple($_POST['contenido']);
			$vComentarios=sanitizar_input_sql($_POST['contenido']);
		//preview($_POST,1);
		if(($vNombres!="")&&($vDni!="")&&($vCorreo!="")&&($vTelefono!="")){

			$vMail="<strong><em>Formulario de Contacto</em></strong><br /><br />";
			$vMail.="<strong>Nombres: </strong>".$vNombres."<br />";
			$vMail.="<strong>Dni: </strong>".$vDni."<br />";
			$vMail.="<strong>Teléfono: </strong>".$vTelefono."<br />";
			$vMail.="<strong>Correo Electrónico: </strong>".$vCorreo."<br />";
			$vMail.="<strong>Comentarios: </strong>".nl2br($vComentarios)."<br />";
			$vMail.="<br><br>Atentamente<br>Equelle<br><br>";

			$vMail=str_replace("[TEXTO]",$vMail,MAIL_CONTENIDO);
			
			$headers = "MIME-Version: 1.0\r\n"; 
            $headers.= "Content-type: text/html;\n Content-Type: image/jpg;\n Content-Transfer-Encoding: base64;\n charset=iso-8859-1\r\n"; 
            // $headers.= 'From: Equelle <administracion@e-quelle.net> \r\n';
            $headers.= 'To: Equelle Contactos <administracion@e-quelle.net> \r\n';
            			
            mail(MAIL_CONTACTO,utf8_decode("Confirmación de envío"),utf8_decode($vMail),$headers);
			
			$vMail="Estimado (a) ".$vNombres."<br><br>Hemos recibido sus comentarios; en breve nos contactaremos con usted.<br><br>Muchas gracias por su tiempo.<br><br>Atentamente<br>Equelle<br><br>";
			$vMail=str_replace("[TEXTO]",$vMail,MAIL_CONTENIDO);

			$headers = "MIME-Version: 1.0\r\n"; 
            $headers.= "Content-type: text/html;\n Content-Type: image/jpg;\n Content-Transfer-Encoding: base64;\n charset=iso-8859-1\r\n"; 
            // $headers.= "From: Equelle<".MAIL_CONTACTO."> \r\n";
            $headers.= "To: ".utf8_decode($vNombres)." <".$vCorreo."> \r\n";
			
			mail($vCorreo,utf8_decode("Confirmación de envío"),utf8_decode($vMail),$headers);

			$vRespuesta='Tu información ha sido enviada, pronto estaremos comunicándonos.';
			die($vRespuesta);
		}else{
			$vRespuesta='Tu información no puede ser procesada, completa correctamente tus datos.';
			die($vRespuesta);
		}
		break;
	case 3: //Enviando solicitud
	
	    // Honeypot: Campo oculto que los bots llenan pero humanos no ven.
		if(!empty($_POST['honey_pie'])){
			die("Error: Bot detectado.");
		}
		
		if(isset($_POST['nombres_sol']))
			// $vNombres=formatear_cadena($_POST['nombres_sol']);
			$vNombres=sanitizar_input_sql($_POST['nombres_sol']);
		if(isset($_POST['dni_sol']))
			$vDni=formatear_numeros($_POST['dni_sol']);
		if(isset($_POST['telefono_sol']))
			$vTelefono=formatear_numeros($_POST['telefono_sol']);
		if(isset($_POST['correo_sol']))
			// $vCorreo=formatear_cadena_simple($_POST['correo_sol']);
			$vCorreo=sanitizar_input_sql($_POST['correo_sol']);
		if(isset($_POST['contenido_sol']))
			// $vComentarios=formatear_cadena_simple($_POST['contenido_sol']);
			$vComentarios=sanitizar_input_sql($_POST['contenido_sol']);
		//preview($_POST,1);
		if(($vNombres!="")&&($vDni!="")&&($vCorreo!="")&&($vTelefono!="")){

			$vMail="<strong><em>Solicitud de servicio</em></strong><br /><br />";
			$vMail.="<strong>Nombres: </strong>".$vNombres."<br />";
			$vMail.="<strong>Dni: </strong>".$vDni."<br />";
			$vMail.="<strong>Teléfono: </strong>".$vTelefono."<br />";
			$vMail.="<strong>Correo Electrónico: </strong>".$vCorreo."<br />";
			$vMail.="<strong>Comentarios: </strong>".nl2br($vComentarios)."<br />";
			$vMail.="<br><br>Atentamente<br>Equelle<br><br>";

			$vMail=str_replace("[TEXTO]",$vMail,MAIL_CONTENIDO);
			
			$headers = "MIME-Version: 1.0\r\n"; 
            $headers.= "Content-type: text/html;\n Content-Type: image/jpg;\n Content-Transfer-Encoding: base64;\n charset=iso-8859-1\r\n"; 
            // $headers.= 'From: Equelle <administracion@e-quelle.net> \r\n';
            $headers.= 'To: Equelle Servicios <administracion@e-quelle.net> \r\n';
            			
            mail(MAIL_CONTACTO,utf8_decode("Solicitud de servicio"),utf8_decode($vMail),$headers);

			
			$vMail='Estimado (a) '.$vNombres.'<br><br>Hemos recibido su solicitud; en breve nos contactaremos con usted.<br><br>Muchas gracias por su tiempo.<br><br>Atentamente<br>Equelle<br><br>';
			$vMail=str_replace("[TEXTO]",$vMail,MAIL_CONTENIDO);

			$headers = "MIME-Version: 1.0\r\n"; 
            $headers.= "Content-type: text/html;\n Content-Type: image/jpg;\n Content-Transfer-Encoding: base64;\n charset=iso-8859-1\r\n"; 
            // $headers.= "From: Equelle<".MAIL_CONTACTO."> \r\n";
            $headers.= "To: ".utf8_decode($vNombres)." <".$vCorreo."> \r\n";
			
			mail($vCorreo,utf8_decode("Confirmación de envío - Solicitud de servicios"),utf8_decode($vMail),$headers);

			$vRespuesta='Tu información ha sido enviada, pronto estaremos comunicándonos.';
			die($vRespuesta);
		}else{
			$vRespuesta='Tu información no puede ser procesada, completa correctamente tus datos.';
			die($vRespuesta);
		}
		break;
}
?>