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

    public function afiliar($txt_usr,$txt_pass,$txt_fecha_nac,$txt_skype,$txt_name,$txt_apellido,$email,$slt_sex,$telefono,$slt_pais,$referido) {
        $this->db->autocommit(FALSE);

        if (!parent::verificaNewAfiliado($txt_usr)) {//verificamos si existe este correo ya afiliado
            if (!parent::agregar($txt_name, $txt_apellido, $email, $slt_sex, $txt_fecha_nac, $telefono, $slt_pais, $txt_skype)) {
                $this->db->rollback();
                $this->db->query("UNLOCK TABLES");
                return $this->estatus;
            }
        }
        
        //buscamos la persona que se agregado
        $persona = $this->db->query("SELECT LAST_INSERT_ID() as 'id_persona', correo FROM personas");
        $persona = $persona->fetch_assoc();
        $id_persona = $persona['id_persona'];
        
        $fecha_creacion = strtotime("now");
        $sql = "insert into contratos (fecha_creacion,id_afiliador,id_persona) values ('$fecha_creacion','$referido','$id_persona')";
        $this->db->query($sql);

        if (!$this->db->errno) {//si no hay errores
            $this->db->commit();
            //verificamos los datos de la persona afiliada
            parent::listarById($id_persona);
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
            $this->mensaje = "Se ha confirmado el pago de la persona con el correo " . $this->datos[0]['correo'];
            $this->estatus = true;
            $this->msgTitle = "aviso";
            $this->json = json_encode($this);
            return $this->estatus;
        }
    }

}

?>