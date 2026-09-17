<?php
require_once "Paginado.php";

class Noticia extends Paginado{
	var $id_noticia;
	var $foto;
	var $fecha;
	var $titulo;
	var $resumen;
	var $contenido;
	var $resaltado;
	var $estado;
	var $orden;

	function __construct($pIntIdNoticia){
	 	if($pIntIdNoticia==""){
			$this->id_noticia	='';
			$this->fecha		='';
			$this->foto			='';
			$this->titulo		='';
			$this->resumen		='';
			$this->contenido	='';
			$this->resaltado	='';
			$this->estado		='';
			$this->orden		='';
		}else{
			$sql="SELECT * FROM noticia WHERE id_noticia=".$pIntIdNoticia;
			$cons=new Consulta($sql);
			if($fila=$cons->obtener_fila()){
				$this->id_noticia	=$fila['id_noticia'];
				$this->fecha		=$fila['fecha'];
				$this->foto			=$fila['foto'];
				$this->titulo		=$fila['titulo'];
				$this->resumen		=$fila['resumen'];
				$this->contenido	=$fila['contenido'];
				$this->resaltado	=$fila['resaltado'];
				$this->estado		=$fila['estado'];
				$this->orden		=$fila['orden'];
			}
		}
	}
	
	function listar($pTinEstado='',$pTinResaltado='',$pIntPagina='',$pIntNroResultados=TOTAL_REGISTROS){
		$arrObj=array();
		$sql=" FROM noticia";
		if($pTinEstado!="")
			$sql.=" WHERE estado=".$pTinEstado;
		if($pTinResaltado!="")
			if(strstr($sql,"WHERE"))
				$sql.=" AND resaltado=".$pTinResaltado;
			else
				$sql.=" WHERE resaltado=".$pTinResaltado;
		$sql.=" ORDER BY orden ASC";
		
		if(($pIntPagina!="")&&($pIntPagina!="0"))
		{	parent::__construct($sql,$pIntNroResultados);
			$sql=$sql." LIMIT ".$this->getInicial($pIntPagina).",".$pIntNroResultados;
		}
		$sql="SELECT id_noticia ".$sql;
		$cons=new Consulta($sql);
		
		if($cons->num_filas()>0)
		{	while ($fila=$cons->obtener_fila())
				$arrObj[]=new Noticia($fila['id_noticia']);
			return $arrObj;
		}
	}
	
	function guardar($arrInput){
		$sql="SELECT MAX(id_noticia)+1 AS maximo FROM noticia";
		$cons=new Consulta($sql);
		if($fila=$cons->obtener_fila())
			$this->id_noticia=$fila['maximo'];
		if($this->id_noticia=="")
			$this->id_noticia=1;
		$sql="UPDATE noticia SET orden=orden+1";
		$cons=new Consulta($sql);
		$this->orden=1;
		   
		$sql="INSERT INTO noticia VALUES(".$this->id_noticia;
		for($i=0;$i<sizeof($arrInput);$i++)
			$sql.=",'".$arrInput[$i]."'";
		$sql.=",".$this->orden.")";
		$cons=new Consulta($sql);
		
		return $this->id_noticia;
	}
	
	function modificar($arrInput)
	{	$sql="UPDATE noticia SET 
			foto='".$arrInput[0]."'
			,fecha='".$arrInput[1]."'
			,titulo='".$arrInput[2]."'
			,resumen='".$arrInput[3]."'
			,contenido='".$arrInput[4]."'
			,resaltado='".$arrInput[5]."'
			,estado='".$arrInput[6]."'
			WHERE id_noticia=".$this->id_noticia;
		$cons=new Consulta($sql);
	}
	
	function mostrarMaxOrden()
	{	$sql="SELECT MAX(orden) AS maximo FROM noticia";
		$cons=new Consulta($sql);
		if($fila=$cons->obtener_fila())
			return $fila['maximo'];
		else 
			return 0;
	}
	
	function ordenar($pIntOrden)
	{	if((int)$this->orden>$pIntOrden)
		{	$sql="UPDATE noticia SET orden=orden+1 WHERE orden>=".$pIntOrden." AND orden<".$this->orden;
			$cons=new Consulta($sql);
		}
		else
		{	$sql="UPDATE noticia SET orden=orden-1 WHERE orden>".$this->orden." AND orden<=".$pIntOrden;
			$cons=new Consulta($sql);
		}
		$sql="UPDATE noticia SET orden=".$pIntOrden." WHERE id_noticia=".$this->id_noticia;
		$cons=new Consulta($sql);
	}
	
	function publicar($pTinEstado){
		$sql="UPDATE noticia SET estado=".$pTinEstado." WHERE id_noticia=".$this->id_noticia;
		$cons=new Consulta($sql);
	}
	
	function resaltar($pIntResaltar){
		$sql="UPDATE noticia SET resaltado=".$pIntResaltar." WHERE id_noticia=".$this->id_noticia;
		$cons=new Consulta($sql);
	}
	
	function eliminar()
	{   $sql="UPDATE noticia SET orden=orden-1 WHERE orden>".$this->orden;
		$cons=new Consulta($sql);
		$sql="DELETE FROM noticia WHERE id_noticia=".$this->id_noticia;
		$cons=new Consulta($sql);
	}
}
?>