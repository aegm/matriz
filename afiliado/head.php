<?php
//print_r($_SESSION);
ini_set('error_report', E_ALL);
error_reporting(E_ALL & ~E_NOTICE);
//error_reporting(0);
ini_set("date.timezone", "America/Caracas");

/* * ************************************** LIBRERIAS GLOBALES ******************************************** */

require_once("../config.php");
require_once("../lib/funciones.php");
require_once("../lib/clases/plantilla.class.php");
require_once("../lib/clases/usuario.class.php");
require_once("../lib/clases/menu.class.php");
//require_once("../lib/clases/permiso.class.php");


/* * *************************************** OJEBTOS GLOBALES ********************************************* */

$html = new plantilla;
$usuario = new usuario;
$menu = new menu;
/* $permiso = new permiso; */
/* * ***************************************** MANTENIMIENTO ********************************************** */

/* if(MANTENIMIENTO)
  mantenimiento(); */

/* * *************************************** PERMISO DE USUARIO ********************************************** */



/* * *************************************** SESSION DE USUARIO ******************************************* */
$matriz['CHAT'] = "";
$matriz['USER_INFO'] = "";
if ($usuario->session()) {
    //	$matriz['CHAT']=$html->html("../html/chat_cliente.html");
    $vars = $_SESSION['gcd'];
    $vars['ROOT_URL'] = ROOT_URL;
    //$matriz['USER_INFO'] = $html->html("html/user_info.html",$vars);
} else
    header("location: ../index.php");

/* * *************************************** MENU DE USUARIO ********************************************** */
$array['submenu_item'] = "";
$matriz['MENU'] = "";
if ($menu->datos)
    foreach ($menu->datos as $item) {
        if ($item['url'] != "#")
            $item['url'] = ROOT_URL . $item['url'];
        if (isset($item['submenu'])) {
            $a_submenu = "";
            foreach ($item['submenu'] as $submenu) {
                if ($submenu['url'] != "#")
                    $submenu['url'] = ROOT_URL . $submenu['url'];
                //if ($permiso->datos[basename($submenu['url'])]['ver'])
                    if ($submenu['id_acceso'] != '5')
                        $a_submenu .= $html->html("../html/submenu_item.html", $submenu);
                    else
                        $a_submenu .= $html->html("../html/boton_chat_cliente.html"); //esto es en caso de tener acceso al chat para clientes
            }
            $item['submenu'] = $html->html("../html/submenu.html", array("submenus" => $a_submenu));
            $matriz['MENU'] .= $html->html("../html/menu.html", $item);
        }
        else {
            $item['submenu'] = "";
            //if ($permiso->datos[basename($item['url'])]['ver'])
                $matriz['MENU'] .= $html->html("../html/menu.html", $item);
        }
    }
/*$consola['CONSOLA'] = "";
$consola['CONSOLA'].="*******************menu*******************\n\n" . print_r($menu->datos, true);
$matriz['CONSOLA'] = $html->html('html/consola.html', $consola);*/


/* * ************************************* VALIDACION DEL BROWSER ****************************************** */

/* $matriz['BROWSER']="";
  $agent=$_SERVER['HTTP_USER_AGENT'];


  $ie=strrpos($agent,"MSIE 6.0");
  if($ie)
  {
  $browser = "html/browser.html";
  $gestor = fopen($browser,"r");
  $contenido = fread($gestor, filesize($browser));
  $matriz['BROWSER']=$contenido;
  } */
/* $ie=strrpos($agent,"MSIE 7.0");
  if($ie)
  {
  $browser = "html/browser.html";
  $gestor = fopen($browser,"r");
  $contenido = fread($gestor, filesize($browser));
  $matriz['BROWSER']=$contenido;
  } */

/* * ************************************ VARIABLES PREDEFINIDAS ******************************************** */

$matriz['TITULO'] = "";
$matriz['MENSAJE'] = "";
$matriz['MSGTIPO'] = "";
$matriz['MSGTITLE'] = "";
$matriz['CONTENIDO'] = "";
$matriz['JS'] = "";
$matriz['CSS'] = "";
$matriz['DERECHO'] = "";
$matriz['ROOT_URL'] = ROOT_URL;
/* if(GOOGLE_ANALYTICS)
  $matriz['GOOGLE_ANALYTICS'] = $html->html(ROOT_DIR.'html/google_analytics.html');
  else
  $matriz['GOOGLE_ANALYTICS'] = "";
  no_index(); */

/* * *************************************** CONSOLA DEL SISTEMA ******************************************** */

if (CONSOLA && $_SERVER['REMOTE_ADDR'] == gethostbyname(DNS_DESARROLLO)) {
    $consola['CONSOLA'] = "******************* VECTOR DE SESSION ********************\n\n" . print_r($_SESSION, true);
    $matriz['CONSOLA'] = $html->html(ROOT_DIR . 'html/consola.html', $consola);
} else
    $matriz['CONSOLA'] = "";

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

if (is_file("js/$archivo" . ".js"))
    $matriz['JS'] .= $html->html("../html/js.html", array("src" => "js/" . $archivo . ".js"));
if (is_file("css/$archivo" . ".css"))
    $matriz['CSS'] = $html->html("../html/css.html", array("href" => "css/" . $archivo . ".css", "media" => "all"));
if (is_file("html/$archivo" . ".html"))
    $matriz['CONTENIDO'] = $html->html("html/$archivo.html");
?>