<?php

require_once('dbi.class.php');
require_once('dbi.result.class.php');
require_once('persona.class.php');
require_once('usuario.class.php');

class contrato extends persona {
    /* private $db;
      public $mensaje;
      public $msgTipo;
      public $msgTitle;
      public $datos="";
      public $json="";
      public $estatus; */

    public function __construct() {
        parent::__construct();
    }

    public function afiliar($txt_name, $txt_apellido, $email, $slt_sex, $txt_fecha_nac, $telefono, $slt_pais) {
        $this->db->autocommit(FALSE);
        if (parent::verificaNewAfiliado($email)) {//verificamos si existe este correo ya afiliado
            if (!parent::agregar($txt_name, $txt_apellido, $email, $slt_sex, $txt_fecha_nac, $telefono, $slt_pais)) {
                
            }
        }
    }

    //**********************************************************************************
    public function contrato_afiliado($id) {//cambiar por la funcion listar
        $contratos = $this->db->query("SELECT * FROM contratos WHERE id_persona='$id' ORDER BY fecha_creacion DESC");
        if (!$contratos->num_rows) {
            $this->mensaje = "No se encontraron registros...";
            $this->msgTipo = "error";
            $this->estatus = false;
            $this->json = json_encode($this);
            return $this->estatus;
        }
        $this->datos = $contratos->fetch_assoc();

        $this->mensaje = "Se ha encontrado el ultimo contrato correctamente...";
        $this->msgTipo = "ok";
        $this->estatus = true;
        $this->json = json_encode($this);
        return $this->estatus;
    }

}

?>