<?php
require_once "Paginado.php";

class ServicioTipo extends Paginado{
	var $id_tipo;
	var $nombre;
	var $orden;

	function __construct($pIntIdTipo){
	 	if($pIntIdTipo==""){
			$this->id_tipo		='';
			$this->nombre		='';
			$this->orden		='';
		}else{	
			$sql="SELECT * FROM servicio_tipo WHERE id_tipo=".$pIntIdTipo;
			$cons=new Consulta($sql);

			if($fila=$cons->obtener_fila()){
				$this->id_tipo		=$fila['id_tipo'];
				$this->nombre		=$fila['nombre'];
				$this->orden		=$fila['orden'];
			}
		}
	}

	function listar($pIntPagina='',$pIntNroResultados=TOTAL_REGISTROS){
		$arrObj=array();
		$sql=" FROM servicio_tipo ORDER BY orden ASC";

		if(($pIntPagina!="")&&($pIntPagina!="0")){
			parent::__construct($sql,$pIntNroResultados);
			$sql=$sql." LIMIT ".$this->getInicial($pIntPagina).",".$pIntNroResultados;
		}
		$sql="SELECT id_tipo ".$sql;
		$cons=new Consulta($sql);

		if($cons->num_filas()>0){
			while ($fila=$cons->obtener_fila())
				$arrObj[]=new ServicioTipo($fila['id_tipo']);
			return $arrObj;
		}
	}
}
?>