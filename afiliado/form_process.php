<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
require_once '../config.php';
require_once '../lib/funciones.php';
require_once '../lib/clases/contrato.class.php';
require_once '../lib/clases/persona.class.php';
require_once '../lib/clases/usuario.class.php';
//require_once '../lib/clases/matriz.class.php';
if (isset($_REQUEST) && count($_REQUEST)) {
    $form_error = false;

    foreach ($_REQUEST as $i => $valor)
        $$i = escapar($valor);

    switch ($form) {
        case 'afiliar':
            $contrato = new contrato;
            $persona = new persona;
            $user = new usuario;
//$matrix = new matriz;
            $afiliador = $_SESSION['gdc']['id_persona'];
            if ($contrato->afiliar($txt_usr, $txt_pass, $txt_fecha_nac, $txt_skype, $txt_name, $txt_apellido, $email, $slt_sex, $telefono, $slt_pais, $referido)) {
//luego de crear la persona y su contrato cremos el usuario
                foreach ($contrato->datos as $campo) {
                    $clave = md5($txt_pass);
                    $user->registrar('1', $txt_usr, $clave, $campo['fecha_creacion'],'3',$campo['id_persona']);
                }
                $_SESSION['mensaje'] = $contrato->mensaje;
                $_SESSION['msgTipo'] = $contrato->msgTipo;
                $_SESSION['msgTitle'] = $contrato->msgTitle;
            }
            $error_redirect_to = ROOT_URL.'afiliar.php';
            $ty_redirect_to = ROOT_URL.'afiliar.php';
            header("Location: " . $lang_dir . $ty_redirect_to);
            break;
        case 'confirma':

            $contrato = new contrato;
            if ($contrato->confirmaAfiliacion($id)) {
                $_SESSION['mensaje'] = $contrato->mensaje;
                $_SESSION['msgTipo'] = $contrato->msgTipo;
                $_SESSION['msgTitle'] = $contrato->msgTitle;
            }
            $error_redirect_to = 'afiliados.php';
            $ty_redirect_to = 'afiliados.php';
            header("Location: " . $lang_dir . $ty_redirect_to);
            break;
        default :
            exit();
            break;
    }
}