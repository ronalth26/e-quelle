<?php
session_start();
$_SESSION['idAdmin']="";
$_SESSION['nombres']="";
    unset($_COOKIE['id_extreme']);
    setcookie('id_extreme', null, -1, '/');
session_destroy();
header("location:index.php");
//linkearURL("index.php");
exit(0);
?>