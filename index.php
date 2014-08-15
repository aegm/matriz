<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();
/* * ************************************ LIBRERIAS LOCALES **************************************** */



/* * ************************************* OJEBTOS LOCALES ***************************************** */



/* * *********************************************************************************************** */

include_once('head.php');

/* * ************************************** VARIABLES DE MATRIZ ************************************* */

/* * ******************************************* CONTENIDO ****************************************** */
$array['login'] = "";
/* if (!$usuario->session()) {
  $array['login'] = $html->html("html/login.html");
  } */
$matriz['CONTENIDO'] = $html->html("html/index.html", $array);
/* * *************************************** MATRIZ ************************************************* */

echo $html->html("html/matriz.html", $matriz);
