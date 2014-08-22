<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '../config.php';
require_once '../lib/funciones.php';
require_once '../lib/clases/contrato.class.php';
require_once '../lib/clases/persona.class.php';
require_once '../lib/clases/usuario.class.php';
if (isset($_POST) && count($_POST)) {
    $form_error = false;

    foreach ($_POST as $i => $valor)
        $$i = escapar($valor);

    switch ($form) {
        case 'afiliar':
            $contrato = new contrato;
            $persona = new persona;
            $user = new usuario;

            $contrato->afiliar($txt_name, $txt_apellido, $email, $slt_sex, $txt_fecha_nac, $telefono);



            break;
    }
}