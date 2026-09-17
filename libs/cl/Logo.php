<?php
require_once "Paginado.php";

class Logo extends Paginado{
	var $id_logo;
	var $foto;
	var $orden;
	function __construct($pIntIdLogo){
	 	if($pIntIdLogo==""){
			$this->id_logo	='';
			$this->foto		='';
			$this->orden	='';
		}else{
			$sql="SELECT * FROM logo WHERE id_logo=".$pIntIdLogo;
			$cons=new Consulta($sql);
			if($fila=$cons->obtener_fila()){
				$this->id_logo		=$fila['id_logo'];
				$this->foto			=$fila['foto'];
				$this->orden		=$fila['orden'];
			}
		}
	}
	
	function listar($pIntPagina='',$pIntNroResultados=TOTAL_REGISTROS)
	{	$arrObj=array();
		$sql=" FROM logo ORDER BY orden ASC";
		if(($pIntPagina!="")&&($pIntPagina!="0")){
			parent::__construct($sql,$pIntNroResultados);
			$sql=$sql." LIMIT ".$this->getInicial($pIntPagina).",".$pIntNroResultados;
		}
		$sql="SELECT id_logo ".$sql;
		$cons=new Consulta($sql);
		if($cons->num_filas()>0){
			while ($fila=$cons->obtener_fila())
				$arrObj[]=new Logo($fila['id_logo']);
			return $arrObj;
		}
	}
	
	function guardar($arrInput){
		$sql="SELECT MAX(id_logo)+1 AS maximo FROM logo";
		$cons=new Consulta($sql);
		if($fila=$cons->obtener_fila())
			$this->id_logo=$fila['maximo'];
		if($this->id_logo=="")
			$this->id_logo=1;
		$sql="UPDATE logo SET orden=orden+1";
		$cons=new Consulta($sql);
		$this->orden=1;
		$sql="INSERT INTO logo VALUES(".$this->id_logo;
		for($i=0;$i<sizeof($arrInput);$i++)
			$sql.=",'".$arrInput[$i]."'";
		$sql.=",".$this->orden.")";
		$cons=new Consulta($sql);
		return $this->id_logo;
	}
	
	function modificar($arrInput){
		$sql="UPDATE logo SET 
		foto='".$arrInput[0]."'
		WHERE id_logo=".$this->id_logo;
		$cons=new Consulta($sql);
	}
	
	function mostrarMaxOrden(){
		$sql="SELECT MAX(orden) AS maximo FROM logo";
		$cons=new Consulta($sql);
		if($fila=$cons->obtener_fila())
			return $fila['maximo'];
		else 
			return 0;
	}
	
	function ordenar($pIntOrden){
		if((int)$this->orden>$pIntOrden){
			$sql="UPDATE logo SET orden=orden+1 WHERE orden>=".$pIntOrden." AND orden<".$this->orden;
			$cons=new Consulta($sql);
		}else{		
			$sql="UPDATE logo SET orden=orden-1 WHERE orden>".$this->orden." AND orden<=".$pIntOrden;
			$cons=new Consulta($sql);
		}
		$sql="UPDATE logo SET orden=".$pIntOrden." WHERE id_logo=".$this->id_logo;
		$cons=new Consulta($sql);
	}
	
	function eliminar()
	{   $sql="UPDATE logo SET orden=orden-1 WHERE orden>".$this->orden;
		$cons=new Consulta($sql);
		$sql="DELETE FROM logo WHERE id_logo=".$this->id_logo;
		$cons=new Consulta($sql);
	}
}
?>