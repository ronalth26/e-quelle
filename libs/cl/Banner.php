<?php
require_once "Paginado.php";

class Banner extends Paginado{
	var $id_banner;
	var $foto;
	var $fotob;
	var $titulo;
	var $subtitulo;
	var $resumen;
	var $enlace;
	var $orden;
		
	function __construct($pIntIdbanner){
	 	if($pIntIdbanner==""){
			$this->id_banner	='';
			$this->foto			='';
			$this->fotob		='';
			$this->titulo		='';
			$this->subtitulo	='';
			$this->resumen		='';
			$this->enlace		='';
			$this->orden		='';
		}else{
			$sql="SELECT * FROM banner WHERE id_banner=".$pIntIdbanner;
			$cons=new Consulta($sql);

			if($fila=$cons->obtener_fila()){
				$this->id_banner	=$fila['id_banner'];
				$this->foto			=$fila['foto'];
				$this->fotob		=$fila['fotob'];
				$this->titulo		=$fila['titulo'];
				$this->subtitulo	=$fila['subtitulo'];
				$this->resumen		=$fila['resumen'];
				$this->enlace		=$fila['enlace'];
				$this->orden		=$fila['orden'];
			}
		}
	}	

	function listar($pIntPagina='',$pIntNroResultados=TOTAL_REGISTROS){
		$arrObj=array();
		$sql=" FROM banner ORDER BY orden ASC";
		if(($pIntPagina!="")&&($pIntPagina!="0")){
			parent::__construct($sql,$pIntNroResultados);
			$sql=$sql." LIMIT ".$this->getInicial($pIntPagina).",".$pIntNroResultados;
		}
		$sql="SELECT id_banner ".$sql;
		$cons=new Consulta($sql);
		
		if($cons->num_filas()>0)
		{	while ($fila=$cons->obtener_fila())
				$arrObj[]=new Banner($fila['id_banner']);
			return $arrObj;
		}
	}
	
	function modificar($arrInput){
		$sql="UPDATE banner SET 
			foto='".$arrInput[0]."'
			,fotob='".$arrInput[1]."'
			,titulo='".$arrInput[2]."'
			,subtitulo='".$arrInput[3]."'
			,resumen='".$arrInput[4]."'
			,enlace='".$arrInput[5]."'
			WHERE id_banner=".$this->id_banner;
		$cons=new Consulta($sql);
	}
	
	function mostrarMaxOrden(){
		$sql="SELECT MAX(orden) AS maximo FROM banner";
		$cons=new Consulta($sql);
		if($fila=$cons->obtener_fila())
			return $fila['maximo'];
		else 
			return 0;
	}
	
	function ordenar($pIntOrden){
		if((int)$this->orden>$pIntOrden){
			$sql="UPDATE banner SET orden=orden+1 WHERE orden>=".$pIntOrden." AND orden<".$this->orden;
			$cons=new Consulta($sql);
		}else{
			$sql="UPDATE banner SET orden=orden-1 WHERE orden>".$this->orden." AND orden<=".$pIntOrden;
			$cons=new Consulta($sql);
		}
		$sql="UPDATE banner SET orden=".$pIntOrden." WHERE id_banner=".$this->id_banner;
		$cons=new Consulta($sql);
	}
}
?>