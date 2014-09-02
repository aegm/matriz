<?php

ini_set('error_report', E_ALL);
error_reporting(E_ALL & ~E_NOTICE);
session_start();

/* * ************************************ LIBRERIAS LOCALES **************************************** */
require_once '../config.php';
require_once '../lib/clases/usuario.class.php';


/* * ************************************* OJEBTOS LOCALES ***************************************** */
$user = new usuario;


/* * *********************************************************************************************** */

include_once('head.php');
/* * ************************************** VARIABLES DE MATRIZ ************************************* */
$user->listarNiveles();
foreach ($user->datos as $registro) {
    //echo $registro['id'];
    $campos = "";
    $i++;
    foreach ($registro as $campo => $valor) {
        if ($campo != "id") {
            $atributos = "";
            $formato = substr(strstr($campo, '..'), 2);
            $valor = formato($formato, $valor);

            
                $array['cabezas'] .= $html->html("html/reporte_cabeza_lista.html", array("cabeza" => str_replace(".." . extension($campo), "", $campo)));


                $campos .= $html->html("html/reporte_campo_lista.html", array("campo" => $valor, "atributos" => $atributos));
            
        }
    }
    if ($i % 2 == 0)
        $clase = "bg_tabla";
    else
        $clase = "";
    $array['registros'] .= $html->html("html/reporte_lista.html", array("tabla" => $tabla, "id" => $registro['id'], "i" => $i, "campos" => $campos, "clase" => $clase));
}
$matriz['CONTENIDO'] = $html->html("html/niveles.html",$array);

//print_r($menu->datos);
echo $html->html("html/matriz.html", $matriz);
