<?php
class ConexionDB
{  var $_dbHost;
   var $_dbName;
   var $_dbUser;
   var $_dbPass;
   var $dbLink;

   //Constructor
   function __construct($dbName=B_NAME)
   {  $this->_dbHost=B_HOST;
      $this->_dbUser=B_USER;
      $this->_dbPass=B_PASS;
      $this->_dbName=$dbName;
	  
		$this->dbLink=mysqli_connect($this->_dbHost,$this->_dbUser,$this->_dbPass);

		mysqli_select_db($this->dbLink,$this->_dbName) or die("Selection of database $mysql_db failed!");

      mysqli_set_charset($this->dbLink, "utf8mb4");
   }
}
?>