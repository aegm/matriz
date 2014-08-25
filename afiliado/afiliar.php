<?php
ini_set('error_report', E_ALL);
error_reporting(E_ALL & ~E_NOTICE);
session_start();
/* * ************************************ LIBRERIAS LOCALES **************************************** */
require_once '../config.php';
require_once '../lib/clases/dbi.class.php';
require_once '../lib/clases/pais.class.php';

/* * ************************************* OJEBTOS LOCALES ***************************************** */
$pais = new pais;


/* * *********************************************************************************************** */

include_once('head.php');
/* * ************************************** CONTENIDO ************************************* */
$pais->listar();
/*print_r($pais->datos);
die();*/
foreach ($pais->datos as $key) {
    /*echo $key['PAI_NOMBRE'];
    die();*/
    $key['nombre'] = $key['PAI_NOMBRE'];
    $key['value'] = $key['id_pais'];
    $array['PAIS'] .= $html->html("../html/form_option.html",$key);
}


/* * ************************************** VARIABLES DE MATRIZ ************************************* */
$matriz['CONTENIDO'] = $html->html("html/afiliar.html", $array);
//print_r($menu->datos);
echo $html->html("html/matriz.html", $matriz);
