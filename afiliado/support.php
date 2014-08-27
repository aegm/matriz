<?php

ini_set('error_report', E_ALL);
error_reporting(E_ALL & ~E_NOTICE);
session_start();
/* * ************************************ LIBRERIAS LOCALES **************************************** */
require_once '../config.php';

/* * ************************************* OJEBTOS LOCALES ***************************************** */



/* * *********************************************************************************************** */

include_once('head.php');
/* * *********************************************************************************************** */





/* * ************************************** VARIABLES DE MATRIZ ************************************* */
$matriz['CONTENIDO'] = $html->html("html/support.html", $array);
//print_r($menu->datos);
echo $html->html("html/matriz.html", $matriz);
