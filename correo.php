<?php
$vMail='Correo de prueba<br>HTML<br>HTML';

$headers = "MIME-Version: 1.0\r\n"; 
$headers.= "Content-type: text/html;\n Content-Type: image/jpg;\n Content-Transfer-Encoding: base64;\n charset=iso-8859-1\r\n"; 
$headers.= 'To: Equelle Prueba <jesus@disac.com.pe> \r\n';
$headers.= 'From: Equelle<jesus@disac.com.pe>\r\n';
			
mail('jesus@disac.com.pe',utf8_decode("Confirmación de envío"),utf8_decode($vMail),$headers);
?>