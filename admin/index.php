<?php

ini_set('error_report', E_ALL);
error_reporting(E_ALL & ~E_NOTICE);
session_start();

/* * ************************************ LIBRERIAS LOCALES **************************************** */
require_once '../config.php';
require_once '../lib/clases/persona.class.php';


/* * ************************************* OJEBTOS LOCALES ***************************************** */
$id_persona = $_SESSION['gdc']['id_persona'];
$persona = new persona();


/* * *********************************************************************************************** */

include_once('head.php');
/* * ************************************** VARIABLES DE MATRIZ ************************************* */

$persona->listarById($id_persona);


foreach ($persona->datos as $campos) {
    $fecha = $campos['fecha_creacion'];
    $campos['fecha_creacion'] = gmdate("d-m-Y", $fecha);
    $matriz['CONTENIDO'] = $html->html("html/index.html", $campos);
}

//print_r($menu->datos);
echo $html->html("html/matriz.html", $matriz);
