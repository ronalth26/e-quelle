<?php
require_once "Paginado.php";

class Admin extends Paginado{
	var $id_admin;
	var $nombre;
	var $email;
	var $uss;
	var $pss;
	var $xtreme;
		
	function __construct($pIntIdAdmin)
	{	if($pIntIdAdmin=="")
		{	$this->id_admin		='';
			$this->nombre		='';
			$this->email		='';
			$this->uss			='';
			$this->pss			='';
			$this->xtreme		='';
		}
		else
		{	$sql="SELECT * FROM admin WHERE id_admin=".$pIntIdAdmin;
			$cons1=new Consulta($sql);
			if($fila=$cons1->obtener_fila())
			{	$this->id_admin		=$fila['id_admin'];
				$this->nombre		=$fila['nombre'];
				$this->email		=$fila['email'];
				$this->uss			=$fila['uss'];
				$this->pss			=$fila['pss'];
				$this->xtreme		=$fila['xtreme'];
			}
		}
	}
	
	function listar($pStrNombres='',$pIntPagina='',$pIntNroResultados=TOTAL_REGISTROS)
	{	$arrObj=array();
		if($pStrNombres!="")
			$sql=" WHERE nombre LIKE '%".$pStrNombres."%'";
		$sql="FROM admin".$sql." ORDER BY nombre ASC";
		
		if(($pIntPagina!="")&&($pIntPagina!="0"))
		{	parent::__construct($sql,$pIntNroResultados);
			$sql=$sql." LIMIT ".$this->getInicial($pIntPagina).",".$pIntNroResultados;
		}
		$sql="SELECT id_admin ".$sql;
		
		$cons=new Consulta($sql);
		if($cons->num_filas()>0)
		{	while ($fila=$cons->obtener_fila())
			{	$arrObj[]=new Admin($fila['id_admin']);
			}
			return $arrObj;
		}
	}
	
	//VALIDAR strEmail
	function validarUsuario($pStrEmail,$pStrPass)
	{	$arrResultados=array();
		$sql="SELECT * FROM admin WHERE uss='".$pStrEmail."' AND pss='".$pStrPass."'";
		$cons=new Consulta($sql);
		
		if($cons->num_filas()>0)
		{	while ($fila=$cons->obtener_fila())
			{	$arrResultados[]=array	(	'id_admin'	=>$fila['id_admin'],
											'nombre'	=>$fila['nombre']
										);
			}
			return $arrResultados;
		}
	}
	function validarCookie($pIdUss,$pIdExtreme)
	{	$arrResultados=array();
		$sql="SELECT * FROM admin WHERE id_admin='".$pIdUss."' AND xtreme='".$pIdExtreme."'";
		$cons=new Consulta($sql);
		
		if($cons->num_filas()>0)
		{	while ($fila=$cons->obtener_fila())
			{	$arrResultados[]=array	(	'id_admin'	=>$fila['id_admin'],
											'nombre'	=>$fila['nombre']
										);
			}
			return $arrResultados;
		}
	}
	
	function guardar($arrInput)
	{	$sql="SELECT COUNT(id_admin) AS total FROM admin WHERE uss='".$arrInput[2]."' AND pss='".$arrInput[3]."'";
		$cons=new Consulta($sql);
		if($fila=$cons->obtener_fila())
			$vIntTotal=$fila['total'];
		if($vIntTotal=="0")
		{	$sql="SELECT max(id_admin)+1 AS max FROM admin";
			$cons=new Consulta($sql);
			if($fila=$cons->obtener_fila())
				$this->id_admin=$fila['max'];
			if($this->id_admin=="")
				$this->id_admin=1;
			$sql="INSERT INTO admin VALUES(".$this->id_admin;		
			for($i=0;$i<sizeof($arrInput);$i++)
				$sql.=",'".$arrInput[$i]."'";
			$sql.=")";
			$cons=new Consulta($sql);
			return $this->id_admin;
		}
		else
			return 0;
	}

	function modificar_cookie($cookie){
		$sql="UPDATE admin SET xtreme='".$cookie."' WHERE id_admin=".$this->id_admin;
		$cons=new Consulta($sql);
	}
	
	function modificar($arrInput)
	{	$sql="UPDATE admin SET 
			nombre='".$arrInput[0]."'
			,email='".$arrInput[1]."'
			,uss='".$arrInput[2]."'
			,pss='".$arrInput[3]."'
			WHERE id_admin=".$this->id_admin;
			$cons=new Consulta($sql);
	}
	
	function publicar($pTinEstado)
	{	$sql="UPDATE admin SET tin_estado=".$pTinEstado." WHERE id_admin=".$this->id_admin;
		$cons=new Consulta($sql);
	}
	
	function eliminar()
	{	$sql="DELETE FROM admin WHERE id_admin=".$this->id_admin;
		$cons=new Consulta($sql);		
	}
	
	function validarEmail($pStrEmail){
		$sql="SELECT * FROM admin WHERE email='".$pStrEmail."'";
		$cons=new Consulta($sql);
		
		if($cons->num_filas()>0)
		{	while ($fila=$cons->obtener_fila())
			{	$arrResultados[]=array	(	'uss'	=>$fila['uss'],
											'pss'	=>$fila['pss']
										);
			}
			return $arrResultados;
		}
	}
}
?>