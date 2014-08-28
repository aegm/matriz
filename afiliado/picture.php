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
$array['ROOT_URL'] = ROOT_URL;
$matriz['JS'] .= $html->html("../html/js.html",array("src"=>"../lib/js/jquery.form.js"));
/* * ************************************** CONTENIDO ************************************* */
$matriz['CONTENIDO'] = $html->html("html/picture.html", $array);
//print_r($menu->datos);
echo $html->html("html/matriz.html", $matriz);