<?php
require_once "Paginado.php";

class Servicio extends Paginado{
	var $id_servicio;
	var $id_tipo;
	var $foto1;
	var $foto2;
	var $foto3;
	var $foto4;
	var $titulo;
	var $resumen;
	var $contenido;
	var $beneficios;
	var $eleccion;
	var $estado;
	var $orden;

	function __construct($pIntIdServicio){
	 	if($pIntIdServicio==""){
			$this->id_servicio	='';
			$this->id_tipo		='';
			$this->foto1		='';
			$this->foto2		='';
			$this->foto3		='';
			$this->foto4		='';
			$this->titulo		='';
			$this->resumen		='';
			$this->contenido	='';
			$this->beneficios	='';
			$this->eleccion		='';
			$this->estado		='';
			$this->orden		='';
		}else{
			$sql="SELECT * FROM servicio WHERE id_servicio=".$pIntIdServicio;
			$cons=new Consulta($sql);
			if($fila=$cons->obtener_fila()){
				$this->id_servicio	=$fila['id_servicio'];
				$this->id_tipo		=$fila['id_tipo'];
				$this->foto1		=$fila['foto1'];
				$this->foto2		=$fila['foto2'];
				$this->foto3		=$fila['foto3'];
				$this->foto4		=$fila['foto4'];
				$this->titulo		=$fila['titulo'];
				$this->resumen		=$fila['resumen'];
				$this->contenido	=$fila['contenido'];
				$this->beneficios	=$fila['beneficios'];
				$this->eleccion		=$fila['eleccion'];
				$this->estado		=$fila['estado'];
				$this->orden		=$fila['orden'];
			}
		}
	}
	
	function listar($pIntIdTipo,$pTinEstado='',$pIntPagina='',$pIntNroResultados=TOTAL_REGISTROS){
		$arrObj=array();
		$sql=" FROM servicio";
		if($pTinEstado!="")
			$sql.=" WHERE estado=".$pTinEstado;
		if($pIntIdTipo!="")
			if(strstr($sql,"WHERE"))
				$sql.=" AND id_tipo=".$pIntIdTipo;
			else
				$sql.=" WHERE id_tipo=".$pIntIdTipo;
		$sql.=" ORDER BY orden ASC";
		
		if(($pIntPagina!="")&&($pIntPagina!="0"))
		{	parent::__construct($sql,$pIntNroResultados);
			$sql=$sql." LIMIT ".$this->getInicial($pIntPagina).",".$pIntNroResultados;
		}
		$sql="SELECT id_servicio ".$sql;
		$cons=new Consulta($sql);
		
		if($cons->num_filas()>0)
		{	while ($fila=$cons->obtener_fila())
				$arrObj[]=new Servicio($fila['id_servicio']);
			return $arrObj;
		}
	}
	
	function guardar($arrInput){
		$sql="SELECT MAX(id_servicio)+1 AS maximo FROM servicio";
		$cons=new Consulta($sql);
		if($fila=$cons->obtener_fila())
			$this->id_servicio=$fila['maximo'];
		if($this->id_servicio=="")
			$this->id_servicio=1;
		$sql="UPDATE servicio SET orden=orden+1 WHERE id_tipo=".$arrInput[0];
		$cons=new Consulta($sql);
		$this->orden=1;
		   
		$sql="INSERT INTO servicio VALUES(".$this->id_servicio;
		for($i=0;$i<sizeof($arrInput);$i++)
			$sql.=",'".$arrInput[$i]."'";
		$sql.=",".$this->orden.")";
		$cons=new Consulta($sql);
		
		return $this->id_servicio;
	}
	
	function modificar($arrInput)
	{	$sql="UPDATE servicio SET 
			foto1='".$arrInput[1]."'
			,foto2='".$arrInput[2]."'
			,foto3='".$arrInput[3]."'
			,foto4='".$arrInput[4]."'
			,titulo='".$arrInput[5]."'
			,resumen='".$arrInput[6]."'
			,contenido='".$arrInput[7]."'
			,beneficios='".$arrInput[8]."'
			,eleccion='".$arrInput[9]."'
			,estado='".$arrInput[10]."'
			WHERE id_servicio=".$this->id_servicio;
			$cons=new Consulta($sql);
	}
	
	function mostrarMaxOrden($pIntIdTipo)
	{	$sql="SELECT MAX(orden) AS maximo FROM servicio WHERE id_tipo=".$pIntIdTipo;
		$cons=new Consulta($sql);
		if($fila=$cons->obtener_fila())
			return $fila['maximo'];
		else 
			return 0;
	}
	
	function ordenar($pIntOrden)
	{	if((int)$this->orden>$pIntOrden)
		{	$sql="UPDATE servicio SET orden=orden+1 WHERE orden>=".$pIntOrden." AND orden<".$this->orden." AND id_tipo=".$this->id_tipo;
			$cons=new Consulta($sql);
		}
		else
		{	$sql="UPDATE servicio SET orden=orden-1 WHERE orden>".$this->orden." AND orden<=".$pIntOrden." AND id_tipo=".$this->id_tipo;
			$cons=new Consulta($sql);
		}
		$sql="UPDATE servicio SET orden=".$pIntOrden." WHERE id_servicio=".$this->id_servicio;
		$cons=new Consulta($sql);
	}
	
	function publicar($pTinEstado){
		$sql="UPDATE servicio SET estado=".$pTinEstado." WHERE id_servicio=".$this->id_servicio;
		$cons=new Consulta($sql);
	}
	
	function eliminar()
	{   $sql="UPDATE servicio SET orden=orden-1 WHERE orden>".$this->orden." AND id_tipo=".$this->id_tipo;
		$cons=new Consulta($sql);
		$sql="DELETE FROM servicio WHERE id_servicio=".$this->id_servicio;
		$cons=new Consulta($sql);
	}
}
?>