<?php
require_once "Paginado.php";

class Cliente extends Paginado{
	var $id_cliente;
	var $foto;
	var $titulo;
	var $contenido;
	var $estado;
	var $orden;

	function __construct($pIntIdCliente){
	 	if($pIntIdCliente==""){
			$this->id_cliente	='';
			$this->foto			='';
			$this->titulo		='';
			$this->contenido	='';
			$this->estado		='';
			$this->orden		='';
		}else{
			$sql="SELECT * FROM cliente WHERE id_cliente=".$pIntIdCliente;
			$cons=new Consulta($sql);
			if($fila=$cons->obtener_fila()){
				$this->id_cliente	=$fila['id_cliente'];
				$this->foto			=$fila['foto'];
				$this->titulo		=$fila['titulo'];
				$this->contenido	=$fila['contenido'];
				$this->estado		=$fila['estado'];
				$this->orden		=$fila['orden'];
			}
		}
	}
	
	function listar($pTinEstado='',$pIntPagina='',$pIntNroResultados=TOTAL_REGISTROS){
		$arrObj=array();
		$sql=" FROM cliente";
		if($pTinEstado!="")
			$sql.=" WHERE estado=".$pTinEstado;
		$sql.=" ORDER BY orden ASC";
		
		if(($pIntPagina!="")&&($pIntPagina!="0"))
		{	parent::__construct($sql,$pIntNroResultados);
			$sql=$sql." LIMIT ".$this->getInicial($pIntPagina).",".$pIntNroResultados;
		}
		$sql="SELECT id_cliente ".$sql;
		$cons=new Consulta($sql);
		
		if($cons->num_filas()>0)
		{	while ($fila=$cons->obtener_fila())
				$arrObj[]=new Cliente($fila['id_cliente']);
			return $arrObj;
		}
	}
	
	function guardar($arrInput){
		$sql="SELECT MAX(id_cliente)+1 AS maximo FROM cliente";
		$cons=new Consulta($sql);
		if($fila=$cons->obtener_fila())
			$this->id_cliente=$fila['maximo'];
		if($this->id_cliente=="")
			$this->id_cliente=1;
		$sql="UPDATE cliente SET orden=orden+1";
		$cons=new Consulta($sql);
		$this->orden=1;
		   
		$sql="INSERT INTO cliente VALUES(".$this->id_cliente;
		for($i=0;$i<sizeof($arrInput);$i++)
			$sql.=",'".$arrInput[$i]."'";
		$sql.=",".$this->orden.")";
		$cons=new Consulta($sql);
		
		return $this->id_cliente;
	}
	
	function modificar($arrInput)
	{	$sql="UPDATE cliente SET 
			foto='".$arrInput[0]."'
			,titulo='".$arrInput[1]."'
			,contenido='".$arrInput[2]."'
			,estado='".$arrInput[3]."'
			WHERE id_cliente=".$this->id_cliente;
			$cons=new Consulta($sql);
	}
	
	function mostrarMaxOrden()
	{	$sql="SELECT MAX(orden) AS maximo FROM cliente";
		$cons=new Consulta($sql);
		if($fila=$cons->obtener_fila())
			return $fila['maximo'];
		else 
			return 0;
	}
	
	function ordenar($pIntOrden)
	{	if((int)$this->orden>$pIntOrden)
		{	$sql="UPDATE cliente SET orden=orden+1 WHERE orden>=".$pIntOrden." AND orden<".$this->orden;
			$cons=new Consulta($sql);
		}
		else
		{	$sql="UPDATE cliente SET orden=orden-1 WHERE orden>".$this->orden." AND orden<=".$pIntOrden;
			$cons=new Consulta($sql);
		}
		$sql="UPDATE cliente SET orden=".$pIntOrden." WHERE id_cliente=".$this->id_cliente;
		$cons=new Consulta($sql);
	}
	
	function publicar($pTinEstado){
		$sql="UPDATE cliente SET estado=".$pTinEstado." WHERE id_cliente=".$this->id_cliente;
		$cons=new Consulta($sql);
	}
	
	function eliminar()
	{   $sql="UPDATE cliente SET orden=orden-1 WHERE orden>".$this->orden;
		$cons=new Consulta($sql);
		$sql="DELETE FROM cliente WHERE id_cliente=".$this->id_cliente;
		$cons=new Consulta($sql);
	}
}
?>