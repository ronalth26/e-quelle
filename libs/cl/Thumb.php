<?php
class Thumb
{	public $valPesoMax;
	public $valFormMax;
	public $valDefecto;
	public $tinNombre;
	public $tinQuitarImg;

	public $imgCalidad;
	public $rutaImg;
	public $arrObjetos;
	public $imgConta;

	function __construct($pImgNombre,$pImgSize,$pImgTemporal,$pTinConservarNombre)
	{	$this->tinNombre		=$pTinConservarNombre;	//Validar si el nombre del archivo final seguirá con el mismo nombre
		$this->arrObjetos		=array();
		$this->arrObjetos[0]	=$pImgNombre;		//Nombre del archivo
		$this->arrObjetos[1]	=$pImgSize;			//Tamaño del archivo
		$this->arrObjetos[2]	=$pImgTemporal;		//Nombre temporal del objeto
		//Separar nombre y formato
		$vTipo=explode(".",$this->arrObjetos[0]);
		$arrNombre=array();
		$arrNombre[0]='';
		$arrNombre[1]='';
		for($k=0;$k<sizeof($vTipo);$k++)
		{	if((int)$k+1==sizeof($vTipo))
				$arrNombre[1]=$vTipo[$k];
			else
				$arrNombre[0].=$vTipo[$k]; 
		}
		$this->arrObjetos[3]	=$arrNombre[0];		//Nombre sin formato
		$this->arrObjetos[4]	=$arrNombre[1];		//Formato solo: Extensión
		
		$this->imgCalidad		=98;				//Calidad por defecto
	}
	
	public function validarObjeto($pStrPrefijo)
	{	if($this->tinQuitarImg=="1"){
			$this->arrObjetos[5]="";				//Nombre Final
			$this->arrObjetos[6]=0;					//Flag sube o no el archivo
		}else{
			if($this->arrObjetos[0]=='')
				$this->imgConta++;
			else{
				if(($this->arrObjetos[1]>$this->valPesoMax)||($this->arrObjetos[1]=="0"))
					$this->imgConta++;
			
				if($this->valFormMax!=""){
					if(strstr($this->valFormMax,",")!="")
						$arrFormat=explode(",",$this->valFormMax);
					else
						$arrFormat[0]=$this->valFormMax;
					
					$acc=0;
					for($i=0;$i<count($arrFormat);$i++)
					{	if(strtoupper($arrFormat[$i])==strtoupper($this->arrObjetos[4]))
							$acc++;
					}
					if($acc==0)
						$this->imgConta++;
				}
			}
			if($this->imgConta==0){
				if($this->tinNombre=="1")
					$this->arrObjetos[5]=strtolower(formatear_seo1($this->arrObjetos[3]).".".$this->arrObjetos[4]);	//
				else																					//Nombre de la imagen
					$this->arrObjetos[5]=strtolower($pStrPrefijo.".".$this->arrObjetos[4]);							//
				$this->arrObjetos[6]=1;																	//Key para saber si se sube o no la imagen
				$size=getimagesize($this->arrObjetos[2]);
				$this->arrObjetos[7]=(int)($size[0]);	//Ancho de la Imagen
				$this->arrObjetos[8]=(int)($size[1]);	//Alto de la Imagen
			}else{
				$this->arrObjetos[5]=$this->valDefecto;
				$this->arrObjetos[6]=0;					//Indicador para saber si el archivo se sube o no 1: Sube, 0: no sube.
			}
		}
	}
	
	public function quitarArchivo($pStrRuta)
	{	//Borrar imagen anterior
		if(($this->tinQuitarImg=="1")&&($this->valDefecto!="")){
			if(file_exists($pStrRuta.$this->valDefecto))
				unlink($pStrRuta.$this->valDefecto);
		}
	}
	
	public function cargarArchivo($pStrIdImagen,$pStrRuta)
	{	if($this->arrObjetos[6]==1){
			//Borrar imagen anterior
			if($this->valDefecto!=""){
				if(file_exists($pStrRuta.$this->valDefecto))
					unlink($pStrRuta.$this->valDefecto);
			}
			//Ruta
			$this->rutaImg=$pStrRuta.$pStrIdImagen.strtolower($this->arrObjetos[5]);
			//Subir Archivo
			copy($this->arrObjetos[2],$this->rutaImg);
		}
	}	

	public function cargarImagen($pStrIdImagen,$pStrRuta,$pTipoCorte,$pIntAnchoPedido,$pIntAltoPedido,$pStrNombre='')
	{	if($this->arrObjetos[6]==1){
		//Ruta
			if($pStrNombre!="")
				$this->rutaImg=$pStrRuta.strtolower($pStrNombre.".".$this->arrObjetos[4]);
			else
				$this->rutaImg=$pStrRuta.$pStrIdImagen.strtolower($this->arrObjetos[5]);
			//Borrar imagen anterior
			if($this->valDefecto!=""){
				if(file_exists($pStrRuta.$this->valDefecto)){
					unlink($pStrRuta.$this->valDefecto);
				}
			}
			//Crear imagen base
			switch(strtoupper($this->arrObjetos[4])){
				case "GIF":		$oGaleriaOld=imagecreatefromgif($this->arrObjetos[2]);break;
				case "JPG":		$oGaleriaOld=imagecreatefromjpeg($this->arrObjetos[2]); break;
				case "JPEG":	$oGaleriaOld=imagecreatefromjpeg($this->arrObjetos[2]); break;
				case "PNG":		$oGaleriaOld=imagecreatefrompng($this->arrObjetos[2]); break;
			}
			//Obtener el tipo de corte a hacer
			if(strstr($pTipoCorte,",")!="")
				$arrCorte=explode(",",$pTipoCorte);
			else
				$arrCorte[0]=$pTipoCorte;
			//Hacer el corte que se requiere
			switch($arrCorte[0])
			{	//Corte simple
				case 1:	$arrDimensiones=explode(",",$this->imgRecortarPuntoMax($this->arrObjetos[7],$this->arrObjetos[8],$pIntAnchoPedido,$pIntAltoPedido,$arrCorte[1]));
						break;
				//Corte especial
				case 2:	$arrDimensiones=explode(",",$this->imgRecortarExacto($this->arrObjetos[7],$this->arrObjetos[8],$pIntAnchoPedido,$pIntAltoPedido));
						break;
				//Corte ambos sin perder el total de la imagen
				case 3: $arrDimensiones=explode(",",$this->imgRecortarPuntoLim($this->arrObjetos[7],$this->arrObjetos[8],$pIntAnchoPedido,$pIntAltoPedido));
						break;
			}
			//Obtener las dimensiones
			$vIntAnchoNor=$this->arrObjetos[7];
			$vIntAltoNor=$this->arrObjetos[8];
			$vIntAnchoFin=$arrDimensiones[0];
			$vIntAltoFin=$arrDimensiones[1];
			
			//Hace la información
			if($arrCorte[0]=="1"){
				$oGaleriaNew=imagecreatetruecolor($vIntAnchoFin,$vIntAltoFin);
				if((strtoupper($this->arrObjetos[4]) == "GIF") OR (strtoupper($this->arrObjetos[4])=="PNG")){
					imagealphablending($oGaleriaNew, false);
					imagesavealpha($oGaleriaNew,true);
					$transparent = imagecolorallocatealpha($oGaleriaNew, 255, 255, 255, 127);
					imagefilledrectangle($oGaleriaNew, 0, 0, $vIntAnchoFin, $vIntAltoFin, $transparent);
				}
				
				imagecopyresampled($oGaleriaNew,$oGaleriaOld,0,0,0,0,$vIntAnchoFin,$vIntAltoFin,$vIntAnchoNor,$vIntAltoNor);
				switch(strtoupper($this->arrObjetos[4])){
					case "GIF":		imagegif($oGaleriaNew,$this->rutaImg,$this->imgCalidad); break;
					case "JPG":		imagejpeg($oGaleriaNew,$this->rutaImg,$this->imgCalidad); break;
					case "JPEG":	imagejpeg($oGaleriaNew,$this->rutaImg,$this->imgCalidad); break;
					case "PNG":		imagepng($oGaleriaNew,$this->rutaImg); break;
				}
				imagedestroy($oGaleriaNew);
			}else{
				$vIntAnchoCortar=$arrDimensiones[2];
				$vIntAltoCortar=$arrDimensiones[3];
				if(($vIntAltoCortar==0)&&($vIntAnchoCortar==0))
				{	$oGaleriaNew=imagecreatetruecolor($vIntAnchoFin,$vIntAltoFin);
					if((strtoupper($this->arrObjetos[4]) == "GIF") OR (strtoupper($this->arrObjetos[4])=="PNG")){
						imagealphablending($oGaleriaNew, false);
						imagesavealpha($oGaleriaNew,true);
						$transparent = imagecolorallocatealpha($oGaleriaNew, 255, 255, 255, 127);
						imagefilledrectangle($oGaleriaNew, 0, 0, $vIntAnchoFin, $vIntAltoFin, $transparent);
					}
					
					imagecopyresampled($oGaleriaNew,$oGaleriaOld,0,0,0,0,$vIntAnchoFin,$vIntAltoFin,$vIntAnchoNor,$vIntAltoNor);
					switch(strtoupper($this->arrObjetos[4])){
						case "GIF":		imagegif($oGaleriaNew,$this->rutaImg,$this->imgCalidad); break;
						case "JPG":		imagejpeg($oGaleriaNew,$this->rutaImg,$this->imgCalidad); break;
						case "JPEG":	imagejpeg($oGaleriaNew,$this->rutaImg,$this->imgCalidad); break;
						case "PNG":		imagepng($oGaleriaNew,$this->rutaImg); break;
					}
					imagedestroy($oGaleriaNew);
				}
				else
				{	if($vIntAltoCortar==1)
					{	//Galeria PIVOTTE
						$oGaleriaTempo=imagecreatetruecolor($vIntAnchoFin,$vIntAltoFin);
						if((strtoupper($this->arrObjetos[4]) == "GIF") OR (strtoupper($this->arrObjetos[4])=="PNG")){
							imagealphablending($oGaleriaTempo, false);
							imagesavealpha($oGaleriaTempo,true);
							$transparent = imagecolorallocatealpha($oGaleriaTempo, 255, 255, 255, 127);
							imagefilledrectangle($oGaleriaTempo, 0, 0, $vIntAnchoFin, $vIntAltoFin, $transparent);
						}
						
						imagecopyresampled($oGaleriaTempo,$oGaleriaOld,0,0,0,0,$vIntAnchoFin,$vIntAltoFin,$vIntAnchoNor,$vIntAltoNor);
						switch(strtoupper($this->arrObjetos[4])){
							case "GIF":		imagegif($oGaleriaTempo,$this->rutaImg,100); break;
							case "JPG":		imagejpeg($oGaleriaTempo,$this->rutaImg,100); break;
							case "JPEG":	imagejpeg($oGaleriaTempo,$this->rutaImg,100); break;
							case "PNG":		imagepng($oGaleriaTempo,$this->rutaImg); break;
						}
						imagedestroy($oGaleriaTempo);
						
						switch(strtoupper($this->arrObjetos[4])){
							case "GIF":		$oGaleriaOldA=imagecreatefromgif($this->rutaImg);break;
							case "JPG":		$oGaleriaOldA=imagecreatefromjpeg($this->rutaImg); break;
							case "JPEG":	$oGaleriaOldA=imagecreatefromjpeg($this->rutaImg); break;
							case "PNG":		$oGaleriaOldA=imagecreatefrompng($this->rutaImg); break;
						}
						$vAux1=intval((int)$vIntAltoFin-(int)$pIntAltoPedido);
						$vCoordY=intval($vAux1/2);
						$oGaleriaNew=imagecreatetruecolor($pIntAnchoPedido,$pIntAltoPedido);
						if((strtoupper($this->arrObjetos[4]) == "GIF") OR (strtoupper($this->arrObjetos[4])=="PNG")){
							imagealphablending($oGaleriaNew, false);
							imagesavealpha($oGaleriaNew,true);
							$transparent = imagecolorallocatealpha($oGaleriaNew, 255, 255, 255, 127);
							imagefilledrectangle($oGaleriaNew, 0, 0, $pIntAnchoPedido, $pIntAltoPedido, $transparent);
						}
						
						imagecopyresampled($oGaleriaNew,$oGaleriaOldA,0,0,0,$vCoordY,$pIntAnchoPedido,$pIntAltoPedido,$pIntAnchoPedido,$pIntAltoPedido);
						switch(strtoupper($this->arrObjetos[4])){
							case "GIF":		imagegif($oGaleriaNew,$this->rutaImg,$this->imgCalidad); break;
							case "JPG":		imagejpeg($oGaleriaNew,$this->rutaImg,$this->imgCalidad); break;
							case "JPEG":	imagejpeg($oGaleriaNew,$this->rutaImg,$this->imgCalidad); break;
							case "PNG":		imagepng($oGaleriaNew,$this->rutaImg); break;
						}
						imagedestroy($oGaleriaNew);
						imagedestroy($oGaleriaOldA);
					}
					if($vIntAnchoCortar==1)
					{	//Galeria PIVOTTE
						$oGaleriaTempo=imagecreatetruecolor($vIntAnchoFin,$vIntAltoFin);
						if((strtoupper($this->arrObjetos[4]) == "GIF") OR (strtoupper($this->arrObjetos[4])=="PNG")){
							imagealphablending($oGaleriaTempo, false);
							imagesavealpha($oGaleriaTempo,true);
							$transparent = imagecolorallocatealpha($oGaleriaTempo, 255, 255, 255, 127);
							imagefilledrectangle($oGaleriaTempo, 0, 0, $vIntAnchoFin, $vIntAltoFin, $transparent);
						}
						
						imagecopyresampled($oGaleriaTempo,$oGaleriaOld,0,0,0,0,$vIntAnchoFin,$vIntAltoFin,$vIntAnchoNor,$vIntAltoNor);
						switch(strtoupper($this->arrObjetos[4])){
							case "GIF":		imagegif($oGaleriaTempo,$this->rutaImg,100); break;
							case "JPG":		imagejpeg($oGaleriaTempo,$this->rutaImg,100); break;
							case "JPEG":	imagejpeg($oGaleriaTempo,$this->rutaImg,100); break;
							case "PNG":		imagepng($oGaleriaTempo,$this->rutaImg); break;
						}
						imagedestroy($oGaleriaTempo);
						
						switch(strtoupper($this->arrObjetos[4])){
							case "GIF":		$oGaleriaOldA=imagecreatefromgif($this->rutaImg);break;
							case "JPG":		$oGaleriaOldA=imagecreatefromjpeg($this->rutaImg); break;
							case "JPEG":	$oGaleriaOldA=imagecreatefromjpeg($this->rutaImg); break;
							case "PNG":		$oGaleriaOldA=imagecreatefrompng($this->rutaImg); break;
						}
						
					$vAux1=intval((int)$vIntAnchoFin-(int)$pIntAnchoPedido);
						$vCoordX=intval((int)$vAux1/2);
						$oGaleriaNew=imagecreatetruecolor($pIntAnchoPedido,$pIntAltoPedido);
					if((strtoupper($this->arrObjetos[4]) == "GIF") OR (strtoupper($this->arrObjetos[4])=="PNG")){
							imagealphablending($oGaleriaNew, false);
							imagesavealpha($oGaleriaNew,true);
							$transparent = imagecolorallocatealpha($oGaleriaNew, 255, 255, 255, 127);
							imagefilledrectangle($oGaleriaNew, 0, 0, $pIntAnchoPedido, $pIntAltoPedido, $transparent);
						}
						
						imagecopyresampled($oGaleriaNew,$oGaleriaOldA,0,0,$vCoordX,0,$pIntAnchoPedido,$pIntAltoPedido,$pIntAnchoPedido,$pIntAltoPedido);
						switch(strtoupper($this->arrObjetos[4])){
							case "GIF":		imagegif($oGaleriaNew,$this->rutaImg,$this->imgCalidad); break;
							case "JPG":		imagejpeg($oGaleriaNew,$this->rutaImg,$this->imgCalidad); break;
							case "JPEG":	imagejpeg($oGaleriaNew,$this->rutaImg,$this->imgCalidad); break;
							case "PNG":		imagepng($oGaleriaNew,$this->rutaImg); break;
						}
						imagedestroy($oGaleriaNew);
						imagedestroy($oGaleriaOldA);
					}
				}
			}
			imagedestroy($oGaleriaOld);
		}
	}
	
	public function agregarMascara($pStrMascaraPng)
	{	switch(strtoupper($this->arrObjetos[4])){
			case "GIF":		$objBanner=imagecreatefromgif($this->rutaImg);break;
			case "JPG":		$objBanner=imagecreatefromjpeg($this->rutaImg); break;
			case "JPEG":	$objBanner=imagecreatefromjpeg($this->rutaImg); break;
			case "PNG":		$objBanner=imagecreatefrompng($this->rutaImg); break;
		}
		$objMascara = imagecreatefrompng($pStrMascaraPng);
		imagecopyresampled($objBanner,$objMascara,0,0,0,0,imagesx($objMascara),imagesy($objMascara),imagesx($objMascara),imagesy($objMascara)); 
		// Damos salida a la imagen final a un archivo
		imagepng($objBanner,$this->rutaImg); 
		// Destruimos las imágenes
		imagedestroy($objBanner);
		imagedestroy($objMascara);
	}
	
	private function imgRecortarPuntoMax($pIntAnchoReal,$pIntAltoReal,$pIntAnchoPedido,$pIntAltoPedido,$solicitado)
	{	if($solicitado=="1") //ANCHO
		{	$solicitado=$pIntAnchoPedido;
			if($pIntAnchoReal>$solicitado)
			{	$pIntAnchoRealF=$solicitado;
				$pIntAltoRealF=((int)$pIntAnchoRealF*(int)$pIntAltoReal)/(int)$pIntAnchoReal;
				$pIntAltoRealF=round($pIntAltoRealF,0);
			}
			else
			{	$pIntAnchoRealF=$pIntAnchoReal;
				$pIntAltoRealF=$pIntAltoReal;
				
			}
		}else{
			$solicitado=$pIntAltoPedido;
			if($pIntAnchoReal>$solicitado)
			{	$pIntAltoRealF=$solicitado;
				$pIntAnchoRealF=((int)$pIntAltoRealF*(int)$pIntAnchoReal)/(int)$pIntAltoReal;
				$pIntAnchoRealF=round($pIntAnchoRealF,0);
			}
			else
			{	$pIntAnchoRealF=$pIntAnchoReal;
				$pIntAltoRealF=$pIntAltoReal;
				
			}
		}
		return $pIntAnchoRealF.",".$pIntAltoRealF;
	}	

	private function imgRecortarExacto($pIntAnchoReal,$pIntAltoReal,$pIntAnchoPedido,$pIntAltoPedido)
	{	$cortaW=0;
		$cortaH=0;
		//TRABAJO CON EL MAYOR
		if((int)$pIntAnchoReal>(int)$pIntAltoReal)										//CASO 1. ANCHO > ALTO
		{	if($pIntAnchoReal<$pIntAnchoPedido)									//CASO 1.1 ANCHO<ANCHOPEDIDO 		==> AGRANDAR EL ANCHO	
			{	$pIntAnchoRealF=$pIntAnchoPedido;
				$pIntAltoRealF=((int)$pIntAnchoRealF*(int)$pIntAltoReal)/(int)$pIntAnchoReal;					//			Igualar el ANCHO FINAL al ANCHO PEDIDO y agrandar el Alto
				$pIntAltoRealF=round($pIntAltoRealF,0);
				if((int)$pIntAltoRealF>(int)$pIntAltoPedido)						//CASO 1.1.1 ALTOF>ALTOPEDIDO		==> ALTO OK Y CORTAR ALTO
				{	$cortaH=1;	}
				elseif((int)$pIntAltoRealF<(int)$pIntAltoPedido)					//CASO 1.1.2 ALTOF<ALTOPEDIDO		==> AGRANDAR EL ALTO Y CORTAR EL ANCHO
				{	$pIntAltoRealF=$pIntAltoPedido;								//			Igualar el ALTO FINAL al ALTO PEDIDO y agrandar el Ancho
					$pIntAnchoRealF=((int)$pIntAnchoReal*(int)$pIntAltoRealF)/(int)$pIntAltoReal;
					$pIntAnchoRealF=round($pIntAnchoRealF,0);
					$cortaW=1;
				}
			}
			elseif($pIntAnchoReal==$pIntAnchoPedido)								//CASO 1.2 ANCHO=ANCHOPEDIDO		==> ANCHO OK VER SI ALTO APLICA
			{	$pIntAnchoRealF=$pIntAnchoReal;
				if($pIntAltoReal<$pIntAltoPedido)									//CASO 1.2.1 ALTO<ALTOPEDIDO		==> AGRANDAR EL ALTO Y CORTA ANCHO
				{	$pIntAltoRealF=$pIntAltoPedido;								//			Igualar el ALTO FINAL al ALTO PEDIDO y agrandar el Ancho
					$pIntAnchoRealF=((int)$pIntAnchoReal*(int)$pIntAltoRealF)/(int)$pIntAltoReal;
					$pIntAnchoRealF=round($pIntAnchoRealF,0);
					$cortaW=1;
				}
				elseif($pIntAltoReal==$pIntAltoPedido)							//CASO 1.2.2 ALTO=ALTOPEDIDO		==> ALTO OK
				{	$pIntAltoRealF=$pIntAltoReal;
				}
				else												//CASO 1.2.3 ALTO>ALTOPEDIDO		==> ALTO OK Y CORTA ALTO
				{	$pIntAltoRealF=$pIntAltoReal;
					$cortaH=1;
				}
			}
			else													//CASO 1.3 ANCHO>ANCHOPEDIDO		==> ACHICAR EL ANCHO
			{	$pIntAnchoRealF=$pIntAnchoPedido;
				$pIntAltoRealF=((int)$pIntAnchoRealF*(int)$pIntAltoReal)/(int)$pIntAnchoReal;					//			Igualar el ANCHO FINAL al ANCHO PEDIDO y agrandar el Alto
				$pIntAltoRealF=round($pIntAltoRealF,0);
				if((int)$pIntAltoRealF>(int)$pIntAltoPedido)						//CASO 1.3.1 ALTOF>ALTOPEDIDO		==> ALTO OK Y CORTAR ALTO
				{	$cortaH=1;	}
				elseif((int)$pIntAltoRealF<(int)$pIntAltoPedido)					//CASO 1.3.2 ALTOF<ALTOPEDIDO		==> AGRANDAR EL ALTO Y CORTAR EL ANCHO
				{	$pIntAltoRealF=$pIntAltoPedido;								//			Igualar el ALTO FINAL al ALTO PEDIDO y agrandar el Ancho
					$pIntAnchoRealF=((int)$pIntAnchoReal*(int)$pIntAltoRealF)/(int)$pIntAltoReal;
					$pIntAnchoRealF=round($pIntAnchoRealF,0);
					$cortaW=1;
				}
			}
			//echo "Ancho";
		}
		elseif((int)$pIntAnchoReal<(int)$pIntAltoReal)									//CASO 2. ANCHO < ALTO
		{	if($pIntAltoReal<$pIntAltoPedido)										//CASO 2.1 ALTO<ALTOPEDIDO	 		==> AGRANDAR EL ALTO	
			{	$pIntAltoRealF=$pIntAltoPedido;
				$pIntAnchoRealF=((int)$pIntAnchoReal*(int)$pIntAltoRealF)/(int)$pIntAltoReal;					//			Igualar el ALTO FINAL al ALTO PEDIDO y agrandar el Ancho
				$pIntAnchoRealF=round($pIntAnchoRealF,0);
				if((int)$pIntAnchoRealF>(int)$pIntAnchoPedido)						//CASO 2.1.1 ANCHOF>ANCHOPEDIDO		==> ANCHO OK Y CORTAR ANCHO
				{	$cortaW=1;	}
				elseif((int)$pIntAnchoRealF<(int)$pIntAnchoPedido)					//CASO 2.1.2 ANCHOF<ANCHOPEDIDO		==> AGRANDAR EL ANCHO Y CORTAR EL ALTO
				{	$pIntAnchoRealF=$pIntAnchoPedido;								//			Igualar el ALTO FINAL al ALTO PEDIDO y agrandar el Ancho
					$pIntAltoRealF=((int)$pIntAltoReal*(int)$pIntAnchoRealF)/(int)$pIntAnchoReal;
					$pIntAltoRealF=round($pIntAltoRealF,0);
					$cortaW=1;
				}
			}
			elseif($pIntAltoReal==$pIntAltoPedido)								//CASO 2.2 ALTO=ALTOPEDIDO			==> ALTO OK VER SI ANCHO APLICA
			{	$pIntAltoRealF=$pIntAltoReal;
				if($pIntAnchoReal<$pIntAnchoPedido)								//CASO 2.2.1 ANCHO<ANCHOPEDIDO		==> AGRANDAR EL ANCHO Y CORTA ALTO
				{	$pIntAnchoRealF=$pIntAnchoPedido;								//			Igualar el ALTO FINAL al ALTO PEDIDO y agrandar el Ancho
					$pIntAltoRealF=((int)$pIntAnchoReal*(int)$pIntAltoReal)/(int)$pIntAnchoReal;
					$pIntAltoRealF=round($pIntAltoRealF,0);
					$cortaH=1;
				}
				elseif($pIntAnchoReal==$pIntAnchoPedido)							//CASO 2.2.2 ANCHO=ANCHOPEDIDO		==> ANCHO OK
				{	$pIntAnchoRealF=$pIntAnchoReal;
				}
				else												//CASO 1.2.3 ANCHO>ANCHOPEDIDO		==> ANCHO OK Y CORTA ANCHO
				{	$pIntAnchoRealF=$pIntAnchoReal;
					$cortaW=1;
				}
			}
			else													//CASO 2.3 ALTO>ANLTOPEDIDO		==> ACHICAR EL ALTO
			{	$pIntAltoRealF=$pIntAltoPedido;
				$pIntAnchoRealF=((int)$pIntAnchoReal*(int)$pIntAltoRealF)/(int)$pIntAltoReal;					//			Igualar el ALTO FINAL al ALTO PEDIDO y agrandar el Ancho
				$pIntAnchoRealF=round($pIntAnchoRealF,0);
				if((int)$pIntAnchoRealF>(int)$pIntAnchoPedido)						//CASO 2.1.1 ANCHOF>ANCHOPEDIDO		==> ANCHO OK Y CORTAR ANCHO
				{	$cortaW=1;	}
				elseif((int)$pIntAnchoRealF<(int)$pIntAnchoPedido)					//CASO 2.1.2 ANCHOF<ANCHOPEDIDO		==> AGRANDAR EL ANCHO Y CORTAR EL ALTO
				{	$pIntAnchoRealF=$pIntAnchoPedido;								//			Igualar el ALTO FINAL al ALTO PEDIDO y agrandar el Ancho
					$pIntAltoRealF=((int)$pIntAltoReal*(int)$pIntAnchoRealF)/(int)$pIntAnchoReal;				//ACA SE CONFIGURA PARA LAS IMAGENES QUE QUIERE OBTENER, AHORA ES PARA 100X60
					$pIntAltoRealF=round($pIntAltoRealF,0);
					$cortaW=1;
				}
			}
			//echo "Alto";
		}
		else														//CASO 3. ANCHO=LARGO 			==> MANEJARLO POR LAS DIMENSIONES PEDIDAS
		{	if((int)$pIntAnchoPedido>(int)$pIntAltoPedido)					//CASO 3.1 ANCHOP>LARGOP		==> ANCHOF OK RESAMPLEAR ALTOF
			{	$pIntAnchoRealF=$pIntAnchoPedido;
				$pIntAltoRealF=((int)$pIntAnchoRealF*(int)$pIntAltoReal)/(int)$pIntAnchoReal;					//			Igualar el ANCHO FINAL al ANCHO PEDIDO y agrandar el Alto
				$pIntAltoRealF=round($pIntAltoRealF,0);
				$cortaH=1;
			}
			elseif((int)$pIntAnchoPedido<(int)$pIntAltoPedido)				//CASO 3.2 ANCHOP>LARGOP		==> ANCHOF OK RESAMPLEAR ALTOF
			{	$pIntAltoRealF=$pIntAltoPedido;									//			Igualar el ALTO FINAL al ALTO PEDIDO y agrandar el Ancho
				$pIntAnchoRealF=((int)$pIntAltoRealF*(int)$pIntAnchoReal)/(int)$pIntAltoReal;
				$pIntAnchoRealF=round($pIntAnchoRealF,0);
				$cortaW=1;
			}
			else													//CASO 3.3 ANCHOP=LARGOP		==> IGUALAR TODOO
			{	$pIntAnchoRealF=$pIntAnchoPedido;
				$pIntAltoRealF=$pIntAltoPedido;
			}
		}
		return $pIntAnchoRealF.",".$pIntAltoRealF.",".$cortaW.",".$cortaH;
	}
	
	private function imgRecortarPuntoLim($pIntAnchoReal,$pIntAltoReal,$tamWGr,$tamHGr)
	{	if((int)$pIntAnchoReal>(int)$pIntAltoReal)
		{	$pIntAltoReal2=(int)$pIntAltoReal*$tamWGr;
			$pIntAltoReal2=(((int)$pIntAltoReal2)/(int)$pIntAnchoReal);
			$pIntAltoRealG=round($pIntAltoReal2,0);
			$pIntAnchoRealG=$tamWGr;
			
			if($pIntAltoRealG>$tamHGr)
			{	$pIntAnchoReal2=$pIntAnchoRealG*$tamHGr;
				$pIntAnchoReal2=(((int)$pIntAnchoReal2)/(int)$pIntAltoRealG);
				$pIntAnchoRealG=round($pIntAnchoReal2,0);
				$pIntAltoRealG=$tamHGr;
			}
		}
		elseif((int)$pIntAnchoReal<(int)$pIntAltoReal)
		{	$pIntAnchoReal2=$pIntAnchoReal*$tamHGr;
			$pIntAnchoReal2=(((int)$pIntAnchoReal2)/(int)$pIntAltoReal);
			$pIntAnchoRealG=round($pIntAnchoReal2,0);
			$pIntAltoRealG=$tamHGr;
			
			if($pIntAnchoRealG>$tamWGr)
			{	$pIntAltoReal2=(int)$pIntAltoRealG*$tamWGr;
				$pIntAltoReal2=(((int)$pIntAltoReal2)/(int)$pIntAnchoRealG);
				$pIntAltoRealG=round($pIntAltoReal2,0);
				$pIntAnchoRealG=$tamWGr;
			}
		}
		else
		{	if($tamWGr>$tamHGr)
			{	$pIntAltoReal2=(int)$pIntAltoReal*$tamWGr;
				$pIntAltoReal2=(((int)$pIntAltoReal2)/(int)$pIntAnchoReal);
				$pIntAltoRealG=round($pIntAltoReal2,0);
				$pIntAnchoRealG=$tamWGr;
			}
			elseif($tamWGr<$tamHGr)
			{	$pIntAnchoReal2=$pIntAnchoReal*$tamHGr;
				$pIntAnchoReal2=(((int)$pIntAnchoReal2)/(int)$pIntAltoReal);
				$pIntAnchoRealG=round($pIntAnchoReal2,0);
				$pIntAltoRealG=$tamHGr;
			}
			else
			{	$pIntAnchoRealG=$tamWGr;
				$pIntAltoRealG=$tamHGr;
			}
		}
		return $pIntAnchoRealG.",".$pIntAltoRealG;
	}
}
?>