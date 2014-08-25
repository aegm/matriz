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

    public function afiliar($txt_name, $txt_apellido, $email, $slt_sex, $txt_fecha_nac, $telefono, $slt_pais, $afiliador, $slt_plan) {
        $this->db->autocommit(FALSE);

        if (!parent::verificaNewAfiliado($email)) {//verificamos si existe este correo ya afiliado
            if (!parent::agregar($txt_name, $txt_apellido, $email, $slt_sex, $txt_fecha_nac, $telefono, $slt_pais, $afiliador)) {
                $this->db->rollback();
                $this->db->query("UNLOCK TABLES");
                return $this->estatus;
            }
        }
        //buscamos la persona que se agregado
        $persona = $this->db->query("SELECT LAST_INSERT_ID() as 'id_persona' FROM personas");
        $persona = $persona->fetch_assoc();
        $id_persona = $this->num_contrato($persona['id_persona']);
        $fecha_creacion = strtotime("now");
        $sql = "insert into contratos (fecha_creacion,fecha_modificacion,id_afiliador,id_plan,id_persona) values ('$fecha_creacion','$fecha_creacion','$afiliador','$slt_plan','$id_persona')";
        $this->db->query($sql);
        if (!$this->db->errno) {//si no hay errores
            $this->db->commit();
            $this->db->query("UNLOCK TABLES"); //desbloqueo ambas tablas
            $this->msgTipo = "ok";
            $this->mensaje = "Se ha afiliado corretamente la informacion fue enviada a su correo";
            $this->estatus = true;
            $this->msgTitle = "aviso";
            $this->json = json_encode($this);
            return $this->estatus;
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

    public function confirmaAfiliacion($id) {
        if (isset($id))
            $sql = "UPDATE contratos set estatus = '1' where id_persona = '$id'";
        $this->db->query($sql);
        if (!$this->db->errno) {//si no hay errores
            //verificamos a quien se le confirma el pago
            parent::listarById($id);
           
            $this->msgTipo = "ok";
            $this->mensaje = "Se ha confirmado el pago de la persona con el correo ".$this->datos[0]['correo'];
            $this->estatus = true;
            $this->msgTitle = "aviso";
            $this->json = json_encode($this);
            return $this->estatus;
        }
    }

}

?>