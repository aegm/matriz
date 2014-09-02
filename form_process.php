<?php

@session_start();
require_once('config.php');
require_once("lib/clases/plantilla.class.php");
//require_once("lib/PHPMailer/class.phpmailer.php");
require_once("lib/clases/usuario.class.php");
//require_once("lib/clases/persona.class.php");
require_once("lib/clases/menu.class.php");
//require_once("lib/clases/permiso.class.php");
require_once("lib/funciones.php");

//error_reporting(0);

function login($usuario, $clave) {
    $user = new usuario;

    if (!$user->login($usuario, $clave)) {
        $_SESSION['mensaje'] = $user->mensaje;
        $_SESSION['msgTipo'] = $user->msgTipo;
        $_SESSION['msgTitle'] = $user->msgTitle;
        return false;
    } else {
        $menu = new menu;
        $menu->iniciar($user->id_grupo);
        //$permiso = new permiso;
        //$permiso->cargar_permisos($user->id_grupo);
        if ($user->id_grupo == AFILIADO)
            return 'afiliado/';
        else
            return 'admin/';
    }
}

if (isset($_POST) && count($_POST)) {
    $form_error = false;

    foreach ($_POST as $i => $valor)
        $$i = escapar($valor);

    switch ($_POST['form']) {
        case 'login':
            if (!$ty_redirect_to = login($usuario, $clave))
                $form_error = true;

            //$error_redirect_to = $pagina;

            break;
        case 'registro-usuario1':
            $error_redirect_to = 'registro.php';

            $persona = new persona;

            if (!$identificacion) {
                $form_error = true;
                $_SESSION['mensaje'] = "Los campos con (*) son obligatorios...";
                $_SESSION['msgTipo'] = "aviso";
                $_SESSION['msgTitle'] = "Registro de usuario";
                exit();
            }
            if ($persona->listar($identificacion, "identificacion")) {
                $user = new usuario;
                /*                 * ************************si la persona existe y trae codigo de libro ************************** */
                if (is_numeric($cod_libro)) {
                    $user->valida_codigo($serial);
                    if ($user->estatus) {

                        $grado = $user->datos[0]['cod_grado'];
                        $cod_libro = $user->datos[0]['cod_libro'];
                        $persona->editar($persona->datos[0]['identificacion'], $persona->datos[0]['id_estado'], $persona->datos[0]['id_ciudad'], $persona->datos[0]['nombre'], $persona->datos[0]['apellido'], $persona->datos[0]['telefono'], $persona->datos[0]['$telefono2'], $persona->datos[0]['$correo'], $persona->datos[0]['$correo2'], $persona->datos[0]['$fecha_nacimiento'], $persona->datos[0]['$direccion'], $persona->datos[0]['$modificado'], $persona->datos[0]['$id_grupo'], $cod_libro);

                        if ($persona->estatus) {
                            $ty_redirect_to = login($usuario, $clave);
                        } else {
                            echo "prueba";
                            $form_error = true;
                            $_SESSION['mensaje'] = "Usted no se encuentra registrado en el sistema";
                            $_SESSION['msgTipo'] = $persona->msgTipo;
                            $_SESSION['msgTitle'] = $persona->msgTitle;
                        }
                    }
                }
                /*                 * ********************************************************************************************* */
                if (!is_numeric($cod_libro)) {
                    if ($form_error = !$user->registro_condicionado($persona->datos[0]['id_persona'], $persona->datos[0]['id_grupo'], $usuario, $clave)) {//es condicionado porque debe estr registrado en el sistema previamente
                        $_SESSION['mensaje'] = $user->mensaje;
                        $_SESSION['msgTipo'] = $user->msgTipo;
                        $_SESSION['msgTitle'] = $user->msgTitle;
                    } else
                        $ty_redirect_to = login($usuario, $clave);
                }
            }
            else {
                /*                 * *****************si la persona no existe pero valida un codigo de libro ********************** */
                if (is_numeric($cod_libro)) {
                    $user = new usuario;
                    $user->valida_codigo($serial);
                    if ($user->estatus) {

                        $grado = $user->datos[0]['cod_grado'];
                        $cod_libro = $user->datos[0]['cod_libro'];
                        $persona->agregar_codicionado($identificacion, $usuario, $grado, $cod_libro, '6', $clave, $reclave);
                        if ($persona->estatus) {
                            $ty_redirect_to = login($usuario, $clave);
                        } else {
                            $_SESSION['mensaje'] = $persona->mensaje;
                            $_SESSION['msgTipo'] = $persona->msgTipo;
                            $_SESSION['msgTitle'] = $persona->msgTitle;
                        }
                    }
                } else {
                    $form_error = true;
                    $_SESSION['mensaje'] = "Usted no se encuentra registrado en el sistema";
                    $_SESSION['msgTipo'] = $persona->msgTipo;
                    $_SESSION['msgTitle'] = $persona->msgTitle;
                }
            }
            break;
        case 'contact':
            $_SESSION['mensaje'] = "";

            if (!$phone) {
                $_SESSION['mensaje'].="* Por favor, coloque un telefono...<br>";
                $_SESSION['msgTipo'] = "error";
                $_SESSION['msgTitle'] = "error";
                $form_error = true;
            }
            if (!PHPMailer::ValidateAddress($email)) {
                $_SESSION['mensaje'].="* Por favor, coloque un correo electrónico válido...<br>";
                $_SESSION['msgTipo'] = "error";
                $_SESSION['msgTitle'] = "error";
                $form_error = true;
            }
            if (!$name) {
                $_SESSION['mensaje'].="* Por favor, coloque su nombre...<br>";
                $_SESSION['msgTipo'] = "error";
                $_SESSION['msgTitle'] = "error";
                $form_error = true;
            }
            if (!$comments) {
                $_SESSION['mensaje'].="* Por favor, especifique su comentario...<br>";
                $_SESSION['msgTipo'] = "error";
                $_SESSION['msgTitle'] = "error";
                $form_error = true;
            }
            if (!$form_error) {
                $message = "<h2>Información de Contacto Washington School</h2>";
                foreach ($_POST as $campo => $valor) {
                    if ($campo != "form")
                        $message.="<strong>$campo: </strong>$valor<br>";
                }
                $html = new plantilla;
                $html->leer("html/mail.html");
                $html->vars(array("BODY" => $message));
                $message = $html->mostrar();

                $para = 'washingtonentuescuela@gmail.com';
                //$para='gilberto.amb@gmail.com';
                $asunto = "Contacto Washington School";

                $cabeceras = 'MIME-Version: 1.0' . "\r\n";
                $cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";
                $cabeceras .= 'From: ' . $name . ' <' . $email . '>' . "\r\n";

                if (!mail($para, $asunto, $message, $cabeceras)) {
                    $form_error = true;
                    $_SESSION['mensaje'] = "An unexpected error ocurred when trying to process your request. Please try again later.";
                    $_SESSION['msgTipo'] = "error";
                    $_SESSION['msgTitle'] = "error";
                } else {
                    $_SESSION['mensaje'] = "Tu mensaje ha sido enviado correctamente...";
                    $_SESSION['msgTipo'] = "ok";
                    $_SESSION['msgTitle'] = "ok";
                }
            }
            $error_redirect_to = 'contactenos.php';
            $ty_redirect_to = 'contactenos.php';
            break;
        default:
            $_SESSION['mensaje'] = 'Formulario especificado no es válido. Póngase en contacto con nosotros si tiene alguna pregunta.';
            $_SESSION['msgTipo'] = "error";
            header("Location: index.php");
            exit();
            break;
    }
    $lang_dir = '';

    if ($form_error) {
        $_SESSION[$_POST['form']] = $_POST;
        header("Location: " . $lang_dir . $error_redirect_to);
        exit();
    }
    try {
        //$user = UserFactory::getUserType($_POST);
        //$user->email();
        //$admin = AdminFactory::getAdminType($_POST);
        //$admin->notify();
        //$subscriber = SubscriberFactory::getSubscriberType($_POST);
        //$subscriber->subscribe();

        unset($_SESSION[$_POST['form']]);
        header("Location: " . $lang_dir . $ty_redirect_to);
    } catch (Exception $e) {
        $_SESSION['active_form'] = $_POST['form'];
        $_SESSION[$_POST['form']] = $_POST;
        $_SESSION['mensaje'] = 'Error inesperado al intentar procesar su solicitud. Por favor, inténtelo de nuevo más tarde.';
        header("Location: " . $lang_dir . $error_redirect_to);
    }
}
?>