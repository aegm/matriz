<?php

session_start();
/* * ************************************ LIBRERIAS LOCALES **************************************** */



/* * ************************************* OJEBTOS LOCALES ***************************************** */



/* * *********************************************************************************************** */

include_once('head.php');
/* * ************************************** VARIABLES DE MATRIZ ************************************* */
$matriz['CONTENIDO'] = $html->html("html/afiliar.html", $array);
//print_r($menu->datos);
echo $html->html("html/matriz.html", $matriz);
