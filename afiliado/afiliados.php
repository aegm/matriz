<?php

ini_set('error_report', E_ALL);
error_reporting(E_ALL & ~E_NOTICE);
session_start();
/* * ************************************ LIBRERIAS LOCALES **************************************** */
require_once '../config.php';
require_once '../lib/clases/persona.class.php';
require_once '../lib/clases/dbi.class.php';

/* * ************************************* OJEBTOS LOCALES ***************************************** */
$persona = new persona;


/* * *********************************************************************************************** */

include_once('head.php');
/* * *********************************************************************************************** */
//buscamos las personas
if ($persona->listar('2', $_SESSION[SISTEMA]['id_persona'])) {
    $array['registros'] = "";
    foreach ($persona->datos as $registro) {
        echo $registro['ID'];
        $campos = "";
        $i++;
        foreach ($registro as $campo => $valor) {
            if ($campo != "ID") {
                $atributos = "";
                $formato = substr(strstr($campo, '..'), 2);
                $valor = formato($formato, $valor);

                if ($campo != 'id_persona' && $campo != 'id_afiliador') {
                    $array['cabezas'] .= $html->html("html/reporte_cabeza_lista.html", array("cabeza" => str_replace(".." . extension($campo), "", $campo)));


                    $campos .= $html->html("html/reporte_campo_lista.html", array("campo" => $valor, "atributos" => $atributos));
                }
            }
        }
        if ($i % 2 == 0)
            $clase = "bg_tabla";
        else
            $clase = "";
        $array['registros'] .= $html->html("html/reporte_lista.html", array("tabla" => $tabla, "id" => $registro['id_persona'], "i" => $i, "campos" => $campos, "clase" => $clase));
    }
}else{
    $array['registros'] = "No tienes ningun afiliado pendiente";
}



/* * ************************************** VARIABLES DE MATRIZ ************************************* */
$matriz['CONTENIDO'] = $html->html("html/afiliados.html", $array);
//print_r($menu->datos);
echo $html->html("html/matriz.html", $matriz);
