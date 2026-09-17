<?php
session_start();
define("APP_BASEDIR", dirname(__FILE__));
define('RELATIVE_PATH',dirname(__FILE__).'/cl/pdf/');
define('FPDF_FONTPATH',dirname(__FILE__).'/cl/pdf/font/');

//CONEXION Y CONSULTA
include APP_BASEDIR . "/md/ac.php";
include APP_BASEDIR . "/md/da.php";
include APP_BASEDIR . "/md/qr.php";

require_once APP_BASEDIR . "/fn/fn.php";
require_once APP_BASEDIR . "/fn/al.php";
require_once APP_BASEDIR . "/fn/df.php";
//CLASES
require_once APP_BASEDIR . "/cl/Paginado.php";
require_once APP_BASEDIR . "/cl/Thumb.php";

require_once APP_BASEDIR . "/cl/Admin.php";
require_once APP_BASEDIR . "/cl/Banner.php";
require_once APP_BASEDIR . "/cl/Cliente.php";
require_once APP_BASEDIR . "/cl/Logo.php";
require_once APP_BASEDIR . "/cl/Noticia.php";
require_once APP_BASEDIR . "/cl/ServicioTipo.php";
require_once APP_BASEDIR . "/cl/Servicio.php";
?>