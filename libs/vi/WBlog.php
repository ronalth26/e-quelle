<?php
switch($acc){
	case 1: //Lista
			if((isset($_GET['cate']))&&($_GET['cate']!=""))
				$vIdCate=formatear_numeros($_GET['cate']);
			elseif((isset($_POST['cate']))&&($_POST['cate']!=""))
				$vIdCate=formatear_numeros($_POST['cate']);
			else
				$vIdCate="";
			
			$obj=new BlogCate('');
			$arrCate=$obj->listar();
			unset($obj);
		
			if($vIdCate==''){
				if(is_array($arrCate))
					$vIdCate=$arrCate[0]->id_cate;
			}

			$obj=new Blog('');
			$listado=$obj->listar($vIdCate,'',$vIntPagAct,8);
			$vIntNumPag=$obj->getTotalPaginas();
			$vIntNumReg=$obj->getTotalRegistros();
			$vIntNumIni=$obj->getInicial($vIntPagAct);
			unset($obj);
			
			$vRutaBlog=HTTP_DIR.OBJ_BLOG;
			break;
	case 2: //Productos
			if((isset($_GET['item']))&&($_GET['item']!=""))
				$vIdBlog=formatear_numeros($_GET['item']);
			elseif((isset($_POST['item']))&&($_POST['item']!=""))
				$vIdBlog=formatear_numeros($_POST['item']);
			else
				$vIdBlog="";
				
			if($vIdBlog=="")
			  linkearUrl("blog.php",1);
		
			$obj=new Blog($vIdBlog);
			$vIdBlog=$obj->id_blog;
		 	$vIdCate=$obj->id_cate;
			$vFecha=fecha_normal($obj->fecha);
			$vFoto=$obj->foto;
			$vFoto1=$obj->foto1;
			$vFoto2=$obj->foto2;
			$vFoto3=$obj->foto3;
			$vFoto4=$obj->foto4;
			$vFoto5=$obj->foto5;
			$vFoto6=$obj->foto6;
			$vArchivo=$obj->archivo;
			$vTitulo=$obj->titulo;
			$vResumen=$obj->resumen;
			$vContenido=$obj->contenido;
		 	$vResaltado=$obj->resaltado;
		 	unset($obj);

			$vRutaBlog=HTTP_DIR.OBJ_BLOG;
		
			$vSeoTitulo=$vTitulo;
			$vSocialDes=cortar_txt($vResumen,190);
			$vSocialUrls=HTTP_DIR."post.php?item=".$vIdBlog;
			$vSocialImg=$vRutaBlog.$vFoto;
			$vSocialUrl=1;
		
			$obj=new Comentario('');
			$comentarios=$obj->listar($vIdBlog,'0','1');
			unset($obj);
			break;
	case 3://Enviando Correo
		if((isset($_GET['item']))&&($_GET['item']!=""))
			$vIdBlog=formatear_numeros($_GET['item']);
		elseif((isset($_POST['item']))&&($_POST['item']!=""))
			$vIdBlog=formatear_numeros($_POST['item']);
		else
			$vIdBlog="";

		if($vIdBlog=="")
		  die("error");
		$vNombres=formatear_cadena($_POST['nombre']);
		$vCorreo=formatear_cadena_simple($_POST['correo']);
		$vComentarios=formatear_cadena_simple($_POST['comentario']);
		//preview($_POST,1);
		if(($vNombres!="")&&($vCorreo!="")&&($vComentarios!="")){
			
			$oBlog=new Blog($vIdBlog);
			$vIdCate=$oBlog->id_cate;
			$vBlog=$oBlog->titulo;
			unset($oBlog);
			
			$arrInput[0]=$vIdBlog;
			$arrInput[1]=$vIdCate;
			$arrInput[2]='0';
			$arrInput[3]=date("Y-m-d")." ".date("H:i:s");
			$arrInput[4]=$vNombres;
			$arrInput[5]=$vCorreo;
			$arrInput[6]=$vComentarios;
			$arrInput[7]='2';
			
			$oCom=new Comentario('');
			$oCom->guardar($arrInput);
			unset($oCom);

			$vMail="<strong><em>Comentarios en Blog</em></strong><br /><br />";
			$vMail.="<strong>Post: </strong>".$vBlog."<br />";
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
			mail(MAIL_CONTACTO,"Comentarios en Blog: ".utf8_decode($vBlog),utf8_decode($vMail),$headers);

			
			$vMail='Estimado (a) '.$vNombres.'<br><br>Hemos recibido sus comentarios en nuestro post: "'.utf8_decode($vBlog).'"; en breve nos contactaremos con usted.<br><br>Muchas gracias por su tiempo.<br><br>Atentamente<br>Rintisa<br><br>*';
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