<?php
switch($acc){
	case 1: //Listado
			$obj=new Cliente('');
			$clientes=$obj->listar('1',$vIntPagAct,12);
			$vIntNumPag=$obj->getTotalPaginas();
			$vIntNumReg=$obj->getTotalRegistros();
			$vIntNumIni=$obj->getInicial($vIntPagAct);
			unset($obj);
			$vRutaCliente=HTTP_DIR.OBJ_CLIENTE;
			break;
}
?>