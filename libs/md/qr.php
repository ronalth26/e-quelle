<?php
require_once "da.php";

class Consulta extends ConexionDB
{  var $result;
 
 //Constructor de la clase
   function __construct($sql)
   {  parent::__construct();
	  $this->result= mysqli_query($this->dbLink, $sql) or die("Invalid Query, " . mysqlI_error($this->dbLink));
   }

   //Devuelve el nro de filas acfectadas
   function filas_afectadas()
   {  return @mysqli_affected_rows();    }

   /*Devuelve el nro de filas de la consulta*/
   function num_filas()
   {  return @mysqli_num_rows($this->result);
   }

   /*obtiene y devuelve la siguiente fila de la consulta*/
   function obtener_fila()
   {  return @mysqli_fetch_array($this->result);
   }
}
?>