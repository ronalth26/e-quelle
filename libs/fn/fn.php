<?php
function fb_app_dc($pValor){
	return base64_decode($pValor);
}
function linkearURL($pStrEnlace,$pIntStop=0)
{	echo "<script language='javascript' type='text/javascript'>";
	echo "location.href='".$pStrEnlace."';";
	echo "</script>";
	if($pIntStop==1)
		exit(0);
}
function validar_array($arrDatos)
{	if((is_array($arrDatos))&&(count($arrDatos)>0))
		return true;
	else
		return false;
}
function formatear_cadena($cadena)
{ 	//elimino etiquetas HTML y PHP 
	$cadena = trim($cadena); 
	$cadena = strip_tags($cadena); 
	//elimino el caracter comilla, que puede estropear una sentencia 
	$cadena = str_replace("'","´",$cadena);  
	$cadena = str_replace('"','&quot;',$cadena);
	$cadena = str_replace('& ','&amp; ',$cadena);
	return $cadena; 
}
function formatear_cadena_simple($cadena)
{ 	//elimino el caracter comilla, que puede estropear una sentencia 
	$cadena = str_replace('<br type="_moz" />','',$cadena); 
	$cadena = str_replace('<br type="_moz">','',$cadena); 
	$cadena = str_replace("'","´",$cadena); 
	if($cadena=='<br>')
		$cadena='';
	if($cadena=='<br />')
		$cadena='';
	return $cadena; 
}
function preview($arrDatos,$pIntStop=0)
{	echo "<pre>";
	print_r($arrDatos);
	echo "</pre>";
	if($pIntStop==1)
		exit(0);
}
function formatear_numeros($cadena)
{ 	//elimino etiquetas HTML y PHP 
	if(is_numeric($cadena))
	{	$cadena = strip_tags($cadena); 
		//elimino el caracter comilla, que puede estropear una sentencia 
		$cadena = str_replace("'","´",$cadena); 
		$cadena = str_replace('"','',$cadena); 
	}
	else
		$cadena='';
	return $cadena; 
}

/**
 * Función robusta para sanitizar inputs y detectar ataques de SQL Injection
 * @param string $vInput Texto a limpiar
 * @return string Texto sanitizado o termina la ejecución si detecta un ataque
 */
function sanitizar_input_sql($vInput) {
    if (empty($vInput)) return "";
    
    // 1. Detección de palabras clave de SQL Injection (Case Insensitive)
    $keywords = array(
        'SELECT', 'UNION', 'UPDATE', 'INSERT', 'DELETE', 'DROP', 'TRUNCATE', 
        'UPDATEXML', 'CONCAT', 'HEX', 'BENCHMARK', 'GROUP_CONCAT', 'INFORMATION_SCHEMA',
        'TABLE_NAME', 'COLUMN_NAME', 'DATABASE', 'SCHEMA'
    );
    foreach ($keywords as $word) {
        // Usamos regex con límites de palabra \b para evitar falsos positivos
        if (preg_match("/\b" . preg_quote($word, '/') . "\b/i", $vInput)) {
            // Escribir en un log si es posible (opcional)
            // error_log("Ataque SQL detectado: " . $vInput);
            die("Error: Actividad sospechosa detectada. Proceso abortado.");
        }
    }
    // 2. Sanitización de caracteres especiales de SQL
    // Reemplazamos caracteres que suelen usarse en escapes o inyecciones
    $search  = array("'", '"', ";", "*", "--", "\\");
    $replace = array("´", "&quot;", "", "", "", "");
    $vInput = str_replace($search, $replace, $vInput);
    // 3. Limpieza estándar (etiquetas HTML y espacios)
    $vInput = trim($vInput);
    $vInput = strip_tags($vInput);
    
    return $vInput;
}

function mostrar_msj($pMsj,$pCssClass='alerta_1'){
	return '<div class="'.$pCssClass.'">'.$pMsj.'</div>';
}
function fecha_normal($fecha)
{	preg_match( "/([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})/", $fecha, $mifecha); 
	$lafecha=$mifecha[3]."/".$mifecha[2]."/".$mifecha[1]; 
	return $lafecha; 
} 
function fecha_mysql($fecha)
{	preg_match( "/([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{2,4})/", $fecha, $mifecha);
 	$lafecha=$mifecha[3]."-".$mifecha[2]."-".$mifecha[1]; 
	return $lafecha;
}
function fecha_especial($pFecha,$pId){
	$arrFecha=explode("-",$pFecha);
	$arrFecha[2]=str_replace("00:00:00","",$arrFecha[2]);
	if($pId=='1'){
		switch($arrFecha[1]){
			case 1: $arrFecha[1]='enero'; break;
			case 2: $arrFecha[1]='febrero'; break;
			case 3: $arrFecha[1]='marzo'; break;
			case 4: $arrFecha[1]='abril'; break;
			case 5: $arrFecha[1]='mayo'; break;
			case 6: $arrFecha[1]='junio'; break;
			case 7: $arrFecha[1]='julio'; break;
			case 8: $arrFecha[1]='agosto'; break;
			case 9: $arrFecha[1]='setiembre'; break;
			case 10: $arrFecha[1]='octubre'; break;
			case 11: $arrFecha[1]='noviembre'; break;
			case 12: $arrFecha[1]='diciembre'; break;
		}
		return $arrFecha[2]." de ".$arrFecha[1]." de ".$arrFecha[0];
	}else{
		switch($arrFecha[1]){
			case 1: $arrFecha[1]='January'; break;
			case 2: $arrFecha[1]='February'; break;
			case 3: $arrFecha[1]='March'; break;
			case 4: $arrFecha[1]='April'; break;
			case 5: $arrFecha[1]='May'; break;
			case 6: $arrFecha[1]='June'; break;
			case 7: $arrFecha[1]='July'; break;
			case 8: $arrFecha[1]='August'; break;
			case 9: $arrFecha[1]='September'; break;
			case 10: $arrFecha[1]='October'; break;
			case 11: $arrFecha[1]='November'; break;
			case 12: $arrFecha[1]='December'; break;
		}
		return $arrFecha[2]." ".$arrFecha[1]." ".$arrFecha[0];
	}
}

function borrarArchivo($pStrRuta)
{	if(file_exists($pStrRuta))
		unlink($pStrRuta);
}
function borrarCarpeta($dirname) { 
   if (is_dir($dirname)) {    //Operate on dirs only 
       $result=array(); 
       if (substr($dirname,-1)!='/') {$dirname.='/';}    //Append slash if necessary 
       $handle = opendir($dirname); 
       while (false !== ($file = readdir($handle))) { 
           if ($file!='.' && $file!= '..') {    //Ignore . and .. 
               $path = $dirname.$file; 
               if (is_dir($path)) {    //Recurse if subdir, Delete if file 
                   $result=array_merge($result,borrarCarpeta($path)); 
               }else{ 
                   unlink($path); 
                   $result[].=$path; 
               } 
           } 
       } 
       closedir($handle); 
       rmdir($dirname);    //Remove dir 
       $result[].=$dirname; 
       return $result;    //Return array of deleted items 
   }else{ 
       return false;    //Return false if attempting to operate on a file 
   } 
}
function crearCarpeta($pStrRuta)
{	if(!(is_dir($pStrRuta)))
	{	mkdir($pStrRuta,0777);
		chmod($pStrRuta,0777);
	}
}

function mostrar_fecha($pFecha,$pIdioma){
	$pFecha=explode("/",$pFecha);
	if($pIdioma=="1"){
		switch ($pFecha[1]){
			case 1: $pMes='enero'; break;
			case 2: $pMes='febrero'; break;
			case 3: $pMes='marzo'; break;
			case 4: $pMes='abril'; break;
			case 5: $pMes='mayo'; break;
			case 6: $pMes='junio'; break;
			case 7: $pMes='julio'; break;
			case 8: $pMes='agosto'; break;
			case 9: $pMes='setiembre'; break;
			case 10: $pMes='octubre'; break;
			case 11: $pMes='noviembre'; break;
			case 12: $pMes='diciembre'; break;
		}
		return $pFecha[0]." de ".$pMes." del ".$pFecha[2];
	}else{
		switch ($pFecha[1]){
			case 1: $pMes='January'; break;
			case 2: $pMes='February'; break;
			case 3: $pMes='March'; break;
			case 4: $pMes='April'; break;
			case 5: $pMes='May'; break;
			case 6: $pMes='June'; break;
			case 7: $pMes='July'; break;
			case 8: $pMes='August'; break;
			case 9: $pMes='Setember'; break;
			case 10: $pMes='October'; break;
			case 11: $pMes='November'; break;
			case 12: $pMes='December'; break;
		}
		return $pMes." ".$pFecha[0].", ".$pFecha[2];
	}
}

function paginacion1($pStrEnlace,$pIntPagAct,$pIntPagTot)
{	if ($pIntPagTot>1)
	{	echo '<div class="pagi">Páginas: ';
		for ($i=1;$i<=$pIntPagTot;$i++)
		{	echo '&nbsp;';
			if(strstr($pStrEnlace,"?")!="")
				$pLink=$pStrEnlace."&amp;pag=".$i;
			else
				$pLink=$pStrEnlace."?pag=".$i;
			if($i==$pIntPagAct)
				echo '<span>'.$i.'</span>';
			else{
				echo '<a href="'.$pLink.'" title="'.$i.'">'.$i.' </a>';
			}
		}
		echo '</div>';
	}
}
function paginacion2($pStrEnlace,$pIntPagAct,$pIntPagTot)
{	if ($pIntPagTot>1)
	{	echo '<div class="paginas_web text-center">';
		for ($i=1;$i<=$pIntPagTot;$i++)
		{	echo '&nbsp;';
			if(strstr($pStrEnlace,"?")!="")
				$pLink=$pStrEnlace."&amp;pag=".$i;
			else
				$pLink=$pStrEnlace."?pag=".$i;
			if($i==$pIntPagAct)
				echo '<a href="javascript:;" class="no-link" title="'.$i.'"><span></span></a>';
			else{
				echo '<a href="'.$pLink.'" title="'.$i.'"><span></span></a>';
			}
		}
		echo '</div>';
	}
}
function img_yt($pStrUrl)
{	if(strstr($pStrUrl,"v=")!="")
	{	$vStrClave=str_replace("v=","",strstr($pStrUrl,"v="));
		$vStrUrl=str_replace("CLAVE",$vStrClave,URL_IMG_YOUTUBE);
	}elseif(strstr($pStrUrl,"http://youtu.be/")!=""){
		$vStrClave=str_replace("http://youtu.be/","",strstr($pStrUrl,"http://youtu.be/"));
		$vStrUrl=str_replace("CLAVE",$vStrClave,URL_IMG_YOUTUBE);
	}
	if(strstr($vStrUrl,"&")!=""){
		$arrSal=explode("&",$vStrUrl);
		return $arrSal[0];
	}else
		return $vStrUrl;
}
function cod_yt($pStrUrl)
{	if(strstr($pStrUrl,"v=")!="")
	{	$vStrClave=str_replace("v=","",strstr($pStrUrl,"v="));
	}elseif(strstr($pStrUrl,"http://youtu.be/")!=""){
		$vStrClave=str_replace("http://youtu.be/","",strstr($pStrUrl,"http://youtu.be/"));
	}
	if(strstr($vStrClave,"&")!=""){
		$arrSal=explode("&",$vStrClave);
		return $arrSal[0];
	}else
		return $vStrClave;
}
function cortar_txt($txt,$nr)
{	$tamano = $nr;
	$contador = 0;
 	$txt = strip_tags($txt);
	$txt = str_replace('<head[^><meta http-equiv="Content-Type" content="text/html; charset=utf-8">]*>.*</head>'," ",$txt);
	$txt = str_replace("<script[^>]*>.*</script>"," ",$txt);
	$txt = str_replace("<style[^>]*>.*</style>"," ",$txt);
	$txt = str_replace("<[^>]*>"," ",$txt);
	$txt = str_replace("&nbsp;","",$txt);
	
	$texto = $txt;
	$texto=str_replace('<br type="_moz" />','<br />',$texto);
	$texto = stripcslashes($texto); 

	if($texto!="")
	{	return substr($texto, 0, ($nr-1));
	}else
		return "";
}
function cortar_txt1($txt,$nr)
{	$tamano = $nr;
	$contador = 0;
	$txt = str_replace("<head[^>]*>.*</head>"," ",$txt);
	$txt = str_replace("<script[^>]*>.*</script>"," ",$txt);
	$txt = str_replace("<style[^>]*>.*</style>"," ",$txt);
	$txt = str_replace("<[^>]*>"," ",$txt);
	$txt = str_replace("&nbsp;","",$txt);

	
	$texto = $txt;
	$texto=str_replace('<br type="_moz" />','<br />',$texto);
	$texto = stripcslashes($texto); 

	if($texto!="")
	{	// Cortamos la cadena por los espacios 
		$arrayTexto = split(' ',$texto); 
		$texto = ''; 	

		// Reconstruimos la cadena 
		while($tamano >= strlen($texto) + strlen($arrayTexto[$contador])){ 
			$texto .= ' '.$arrayTexto[$contador]; 
			$contador++; 
		} 
		
		return $texto."...";
	}else
		return "";
}

function paginar_web($vEnlace,$vIntPagAct,$vIntNumPag,$vPagGrupo=10){
	$vPaginado='';
	if(strstr($vEnlace,"?")!="")
		$vEnlace.='&';
	else
		$vEnlace.='?';
	$vEnlace.='pag=';
	if($vIntNumPag>1){
		if($vIntNumPag<$vPagGrupo)
			$vPagGrupo=$vIntNumPag;
		$vTotGrupo=$vIntNumPag/$vPagGrupo;
		if(strstr($vTotGrupo,".")!=""){
			$aGrupo=explode(".",$vTotGrupo);
			$vTotGrupo=$aGrupo[0]+1;
		}
		for($i=1;$i<=$vTotGrupo;$i++){
			if($i==1){
				$vPIni=1;
				$vPFin=$i*$vPagGrupo;
			}elseif($i==$vTotGrupo){
				$vPIni=(($i-1)*$vPagGrupo)+1;
				$vPFin=$vIntNumPag;
			}else{
				$vPIni=(($i-1)*$vPagGrupo)+1;
				$vPFin=$i*$vPagGrupo;
			}
			if(($vPIni<=$vIntPagAct)&&($vPFin>=$vIntPagAct)){
				$vPInicio=$vPIni;
				$vPFinal=$vPFin;
				if($vPInicio==1)
					$vGrupoAnt='';
				else
					$vGrupoAnt=$vPInicio-1;
				if($vPFinal==$vIntNumPag)
					$vGrupoSig='';
				else
					$vGrupoSig=$vPFin+1;
			}
		}
		if($vGrupoAnt!="")
			$vPaginado.='<a class="transicion" href="'.$vEnlace.$vGrupoAnt.'" title="'.$vGrupoAnt.'">&lt;</a>';
		for($i=$vPInicio;$i<=$vPFinal;$i++){
			if($i==$vIntPagAct)
				$vSeleccion=' sel';
			else
				$vSeleccion=' nor';
			$vPaginado.='&nbsp;<a class="transicion'.$vSeleccion.'" href="'.$vEnlace.$i.'" title="'.$i.'">'.$i.'</a>';
		}
		if($vGrupoSig!="")
			$vPaginado.='&nbsp;<a class="transicion" href="'.$vEnlace.$vGrupoSig.'" title="'.$vGrupoSig.'">&gt;</a>';
	}
	return $vPaginado;
}

function paginar_web1($vEnlace,$vIntPagAct,$vIntNumPag,$vPagGrupo=10,$pEspacio='1'){
	if(strstr($vEnlace,"?")!="")
		$vEnlace.='&';
	else
		$vEnlace.='?';
	$vEnlace.='pag=';
	if($vIntNumPag>1){
		if($vIntNumPag<$vPagGrupo)
			$vPagGrupo=$vIntNumPag;
		$vTotGrupo=$vIntNumPag/$vPagGrupo;
		if(strstr($vTotGrupo,".")!=""){
			$aGrupo=explode(".",$vTotGrupo);
			$vTotGrupo=$aGrupo[0]+1;
		}
		for($i=1;$i<=$vTotGrupo;$i++){
			if($i==1){
				$vPIni=1;
				$vPFin=$i*$vPagGrupo;
			}elseif($i==$vTotGrupo){
				$vPIni=(($i-1)*$vPagGrupo)+1;
				$vPFin=$vIntNumPag;
			}else{
				$vPIni=(($i-1)*$vPagGrupo)+1;
				$vPFin=$i*$vPagGrupo;
			}
			if(($vPIni<=$vIntPagAct)&&($vPFin>=$vIntPagAct)){
				$vPInicio=$vPIni;
				$vPFinal=$vPFin;
				if($vPInicio==1)
					$vGrupoAnt='';
				else
					$vGrupoAnt=$vPInicio-1;
				if($vPFinal==$vIntNumPag)
					$vGrupoSig='';
				else
					$vGrupoSig=$vPFin+1;
			}
		}
		$vPaginado.='<div class="row paginacion">';
		if($vGrupoAnt!="")
			$vPaginado.='<a class="flecha" href="'.$vEnlace.$vGrupoAnt.'" title="'.$vGrupoAnt.'"><i class="fa fa-chevron-left" aria-hidden="true"></i></a>';
		for($i=$vPInicio;$i<=$vPFinal;$i++){
			if($i==$vIntPagAct)
				$vSeleccion='class="seleccionado"';
			else
				$vSeleccion='';
			$vPaginado.='&nbsp;<a '.$vSeleccion.' href="'.$vEnlace.$i.'" title="'.$i.'">'.$i.'</a>';
		}
		if($vGrupoSig!="")
			$vPaginado.='&nbsp;<a class="flecha" href="'.$vEnlace.$vGrupoSig.'" title="'.$vGrupoSig.'"><i class="fa fa-chevron-right" aria-hidden="true"></i></a>';
		$vPaginado.='</div>';
	}else{
		if($pEspacio=='1')
			$vPaginado='<div style="padding-bottom: 60px;">&nbsp;</div>';
	}
	return $vPaginado;
}
?>