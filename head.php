<?php

ini_set('error_report', E_ALL);
error_reporting(E_ALL & ~E_NOTICE);
/* * ************************************** LIBRERIAS GLOBALES ******************************************* */
require_once 'config.php';
require_once("lib/clases/plantilla.class.php");
//require_once("lib/clases/usuario.class.php");
require_once("lib/funciones.php");
/* * *************************************** OJEBTOS GLOBALES ******************************************** */
$html = new plantilla;
/* * ************************************ VARIABLES PREDEFINIDAS ******************************************** */
$matriz['ROOT_URL'] = ROOT_URL;
$matriz['JS'] = "";
/* * *************************************** SESSION DE USUARIO ******************************************* */

/* * *************************************** MENSAJES GENERALES ********************************************* */

if (isset($_SESSION['mensaje'])) {
    if ($_SESSION['msgTipo'] == "aviso")
        $i['icon'] = "ui-icon-alert";
    if ($_SESSION['msgTipo'] == "error")
        $i['icon'] = "ui-icon-circle-close";
    if ($_SESSION['msgTipo'] == "ok")
        $i['icon'] = "ui-icon-circle-check";
    if ($_SESSION['msgTipo'] == "info")
        $i['icon'] = "ui-icon-info";
    $matriz['MENSAJE'] = $_SESSION['mensaje'];
    $matriz['MSGTIPO'] = $_SESSION['msgTipo'];
    $matriz['MSGTITLE'] = $_SESSION['msgTitle'];
    unset($_SESSION['mensaje']);
    unset($_SESSION['msgTipo']);
    unset($_SESSION['msgTitle']);
}
/* * *************************************** ARCHIVOS CSS y JS ************************************************ */

$archivo = basename($_SERVER['PHP_SELF']);
$archivo = explode(".", $archivo);
$archivo = $archivo[0];

if (is_file("lib/js/$archivo" . ".js"))
    $matriz['JS'].=$html->html(ROOT_DIR . "html/js.html", array("src" => "lib/js/" . $archivo . ".js", "ROOT_URL" => ROOT_URL));
