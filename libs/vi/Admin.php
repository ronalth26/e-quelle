<?php
switch ($acc)
{	case 1:
		$oAdmin=new Admin($_SESSION['idAdmin']);
		$vIntIdAdmin=$oAdmin->id_admin;
		$vStrNombre=$oAdmin->nombre;
		$vStrEmail=$oAdmin->email;
		$vStrUss=$oAdmin->uss;
		$vStrPss=$oAdmin->pss;
		unset($oAdmin);
		break;
	case 2:
		$arrInput[0]=formatear_cadena(trim($_POST['txt_nombre']));
		$arrInput[1]=formatear_cadena(trim($_POST['txt_email']));
		$arrInput[2]=formatear_cadena(trim($_POST['txt_uss']));
		$arrInput[3]=formatear_cadena(trim($_POST['txt_pss']));
		
		$oAdmin=new Admin($_SESSION['idAdmin']);
		$oAdmin->modificar($arrInput);
		unset($oAdmin);
		
		linkearUrl("admin.php?msg=2",1);
		break;
	case 5:				
		if((isset($_POST['txt_uss']))&&(isset($_POST['txt_pss'])))
		{	$vStrUsuario=formatear_cadena(trim($_POST['txt_uss']));
			$vStrClave=formatear_cadena(trim($_POST['txt_pss']));
			$oAdmin=new Admin('');
			$listAdmin=$oAdmin->validarUsuario($vStrUsuario,$vStrClave);
			unset($oAdmin);
			if(is_array($listAdmin))
			{	$_SESSION['idAdmin']=$listAdmin[0]['id_admin'];
				$_SESSION['nombres']=$listAdmin[0]['nombre'];
				
				if((isset($_POST['chk_recordar']))){
					if ($HTTP_X_FORWARDED_FOR == "")
						$ip = getenv(REMOTE_ADDR);
					else
						$ip = getenv(HTTP_X_FORWARDED_FOR);
					$id_extreme = md5(uniqid(rand(), true));
					$id_extreme2 = $_SESSION['idAdmin']."%".$id_extreme."%".$ip;
					setcookie('id_extreme', $id_extreme2, time()+7776000,'/');
					
					$oA=new Admin($_SESSION['idAdmin']);
					$oA->modificar_cookie($id_extreme);
					unset($oA);
				}
				linkearURL("index.php");
				exit(0);
			}
			else
			{	//header("location:index.php?err=2");
				linkearURL("index.php?err=2");
				exit(0);
			}
		}
		else
		{	//header("location:index.php?err=1");
			linkearURL("index.php?err=1");
			exit(0);
		}
		break;
	case 6://Validar cookie
		if(isset($_COOKIE['id_extreme'])) 
		{	$cookie = htmlentities($_COOKIE['id_extreme']);
			$cookie = explode("%",$cookie);
			$admin = $cookie[0];
			$id = $cookie[1];
			$ip = $cookie[2];
			if ($HTTP_X_FORWARDED_FOR == "")
				$ip2 = getenv(REMOTE_ADDR);
			else
				$ip2 = getenv(HTTP_X_FORWARDED_FOR);
				
			if($ip == $ip2){
				$oA=new Admin('');
				$listAdmin=$oA->validarCookie($admin,$id);
				if(is_array($listAdmin))
				{	$_SESSION['idAdmin']=$listAdmin[0]['id_admin'];
					$_SESSION['nombres']=$listAdmin[0]['str_nombres'];
					
					linkearURL("index.php");
					exit(0);
				}else
					linkearURL("index.php?err=0","1");
			}else
				linkearURL("index.php?err=0","1");
		}else
			linkearURL("index.php?err=0","1");
		break;
	case 7://Recuperar contraseña
		$vStrEmail=formatear_cadena_simple(trim($_POST['txt_uss']));
		$oA=new Admin('');
		$listAdmin=$oA->validarEmail($vStrEmail);

		if(is_array($listAdmin))
		{	$vEmail='Estimado Administrador:<br />';
			$vEmail='Recibimos su pedido de recuperación de datos de acceso. A continuación enviamos la información pedida:<br />';
			$vEmail.='Usuario: '.$listAdmin[0]['uss']."<br />Contraseña: ".$listAdmin[0]['pss'];
			$vEmail.='<br /><br />Podrá acceder al Panel Administrable Equelle con estos datos.';
			$vEmail='<div style="font-family: Arial, Helvetica, sans-serif; font-size: 10px">'.$vEmail.'</div>';		

			$headers = "MIME-Version: 1.0\r\n"; 
			$headers.= "Content-type: text/html;\n Content-Type: image/jpg;\n Content-Transfer-Encoding: base64;\n charset=iso-8859-1\r\n"; 
			$headers.= "From: Panel Administrable Equelle <".MAIL_CONTACTO.">\r\n";
			
			mail($vStrEmail,utf8_decode('Recuperación de contraseña'),utf8_decode($vEmail),$headers);	

			linkearURL("recuperar.php?msj=1",1);
		}else
			linkearURL("recuperar.php?msj=0",1);
			
		break;
}	
?>