<?php
/****************************************** CONFIGURACION DEL SISTEMA ************************************************/
define('AFILIADO','1');
define('','2');
define('','3');
define('','4');
define('','5');
define('','6');
/****************************************** CONFIGURACION GENERAL DEL SITIO *******************************************/
/** cambia el root del apache. **/
define('ROOT_DIR', dirname(__FILE__) . '/');
define('ROOT_URL', 'http://localhost/matriz/');
/*define('ROOT_DIR', dirname(__FILE__) . '/');
define('ROOT_URL', 'http://desarrollo.interfasedigital.com.ve/');**/
/**activa los tipos de erroes del servidor **/

ini_set('error_report', E_ALL);
error_reporting(E_ALL);  
/********************************************** MYSQL BASE DE DATOS ***************************************************/
/** El nombre de tu base de datos */
define("DB_NAME", "matriz");
//define("DB_NAME","C243473_matriz");
//Tu nombre de usuario de MySQL 
//define('DB_USER', 'C243473_matriz');
define('DB_USER', 'root');

/** Tu contraseña de MySQL */
//define('DB_PASS', 'C243473_matr');
define('DB_PASS', '1234');

/** Host de MySQL (es muy probable que no necesites cambiarlo) */
//define('DB_HOST', 'mysql500.ixwebhosting.com'); 
define('DB_HOST', 'localhost');

/** Puerto de conexión del servidor Mysql. * */
define("DB_PORT", "3306");

/** Codificación de caracteres para la base de datos. * */
define('DB_CHARSET', 'utf8');

