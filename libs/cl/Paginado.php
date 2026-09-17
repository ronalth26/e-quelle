<?php
class Paginado
{	private $intResTotReg;
	private $intResTotPag;
	private $div1;
	private $div2;
	private $intRegIni;
	private $intRegFin;
	private $intTotRegistros;
	
	public function __construct($pStrQuery,$pIntRegistros=TOTAL_REGISTROS,$pTipoConteo=1)
	{	$this->intTotRegistros=$pIntRegistros;
		if($pTipoConteo==1)
		{	$sql="SELECT COUNT(*) AS total ".$pStrQuery;
			$cons=new Consulta($sql);
			if($fila=$cons->obtener_fila())
				$this->intResTotReg=$fila['total'];
			else
				$this->intResTotReg=0;

		}else{

			$cons=new Consulta($pStrQuery);

			if($fila=$cons->obtener_fila())

				$this->intResTotReg=$cons->num_filas();

			else

				$this->intResTotReg=0;

		}

		if(((int)$this->intResTotReg>0)&&(is_numeric($this->intResTotReg)))

		{	$this->div1=$this->intResTotReg/$pIntRegistros;

			$this->div2=explode(".",$this->div1);

			if(isset($this->div2[1]))

				$this->intResTotPag=$this->div2[0]+1;

			else

				$this->intResTotPag=$this->div1;

		}

		else

		{	$this->intResTotReg=0;

			$this->div1=0;

			$this->div2=0;

			$this->intResTotPag=0;

		}

	}

	

	public function getTotalRegistros()

	{	return $this->intResTotReg;

	}

	public function getTotalPaginas()

	{	return $this->intResTotPag;

	}	

	public function getInicial($pIntPaginaActual)

	{	if($pIntPaginaActual==1)

			$this->intRegIni=0;

		else

			$this->intRegIni=($pIntPaginaActual-1)*$this->intTotRegistros;

		return $this->intRegIni;

	}

	public function getFinal($pIntPaginaActual)

	{	if($pIntPaginaActual*$this->intTotRegistros>$this->intResTotReg)

			$this->intRegFin=$this->intResTotReg;

		else

			$this->intRegFin=$pIntPaginaActual*$this->intTotRegistros;

		return $this->intRegFin;

	}

}

?>