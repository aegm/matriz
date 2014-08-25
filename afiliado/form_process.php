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
if (isset($_REQUEST) && count($_REQUEST)) {
    $form_error = false;

    foreach ($_REQUEST as $i => $valor)
        $$i = escapar($valor);

    switch ($form) {
        case 'afiliar':
            $contrato = new contrato;
            $persona = new persona;
            $user = new usuario;
            $afiliador = $_SESSION['gdc']['id_persona'];
            if ($contrato->afiliar($txt_name, $txt_apellido, $email, $slt_sex, $txt_fecha_nac, $telefono, $slt_pais, $afiliador, $slt_plan)) {
                //verificamos la matrix de la persona que me trajo como referido y comprobamos a quien se le va a realizar el pago
                
                $_SESSION['mensaje'] = $contrato->mensaje;
                $_SESSION['msgTipo'] = $contrato->msgTipo;
                $_SESSION['msgTitle'] = $contrato->msgTitle;
            }
            $error_redirect_to = 'afiliar.php';
            $ty_redirect_to = 'afiliar.php';
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