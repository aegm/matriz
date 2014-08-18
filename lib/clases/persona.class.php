<?php

require_once('dbi.class.php');
require_once('dbi.result.class.php');

class persona {

    protected $db;
    public $mensaje;
    public $msgTipo;
    public $msgTitle;
    public $datos = "";
    public $json = "";
    public $estatus;

    public function __construct() {
        $this->db = new db;
    }

    //********************************************************
    public function tiene_cupos($identificacion) {
        $this->db = new db;
        $cupos = $this->db->query("SELECT cupo FROM personas WHERE identificacion='$identificacion'");
        if (!$this->db->errno) {
            $cupo = $cupos->fetch_assoc();
            if ($cupo['cupo'] > 0) {
                $this->mensaje = "Si posee cupos...";
                $this->msgTipo = "ok";
                $this->estatus = true;
                $this->json = json_encode($this);
                return $this->estatus;
            } else {
                $this->mensaje = "No posee cupos...";
                $this->msgTipo = "aviso";
                $this->estatus = false;
                $this->json = json_encode($this);
                return $this->estatus;
            }
        }
        $this->mensaje = "Disculpe, en este momento no se pudo agregar a la persona, por favor intente en otro momento o contacte a soporte tecnico...";
        $this->msgTipo = "error";
        $this->estatus = false;
        $this->json = json_encode($this);
        return $this->estatus;
    }

    //********************************************************
    public function cupos($identificacion, $operador, $cantidad) {
        $this->db = new db;
        $this->db->query("UPDATE personas SET cupo=cupo$operador$cantidad WHERE identificacion = '$identificacion'");


        if (!$this->db->errno) {
            $this->mensaje = "La operacion se ha realizado con exito";
            $this->msgTipo = "ok";
            $this->estatus = true;
            $this->json = json_encode($this);
            return $this->estatus;
        }
        $this->mensaje = "Disculpe, en este momento no se pudo agregar a la persona, por favor intente en otro momento o contacte a soporte tecnico (operacion erronea)...";
        $this->msgTipo = "error";
        $this->estatus = false;
        $this->json = json_encode($this);
        return $this->estatus;
    }

    //***********************************************************************************************************
    public function agregar($identificacion, $id_estado, $id_ciudad, $nombre, $apellido, $telefono, $telefono2, $correo, $correo2, $fecha_nacimiento, $direccion, $creado, $modificado, $id_grupo, $id_pais) {
        if (!$identificacion) {
            $this->mensaje = "El campo identificacion, es obligatorios...";
            $this->msgTipo = "aviso";
            $this->estatus = false;
            $this->json = json_encode($this);
            return $this->estatus;
        }
        if (!$nombre) {
            $this->mensaje = "El campo nombre, es obligatorios...";
            $this->msgTipo = "aviso";
            $this->estatus = false;
            $this->json = json_encode($this);
            return $this->estatus;
        }
        if (!$apellido) {
            $this->mensaje = "El campo apellido, es obligatorios...";
            $this->msgTipo = "aviso";
            $this->estatus = false;
            $this->json = json_encode($this);
            return $this->estatus;
        }
        if (!$telefono) {
            $this->mensaje = "El campo telefono, es obligatorios...";
            $this->msgTipo = "aviso";
            $this->estatus = false;
            $this->json = json_encode($this);
            return $this->estatus;
        }
        if (!$id_grupo) {
            $this->mensaje = "El campo Nivel, es obligatorios...";
            $this->msgTipo = "aviso";
            $this->estatus = false;
            $this->json = json_encode($this);
            return $this->estatus;
        }
        //validar que todas las variables requeridas esten llenas
        $this->db = new db;
        $fecha_modificacion = $fecha_creacion = strtotime("now");

        $campo_completarsql_1 = "";
        $campo_completarsql_2 = "";
        if ($fecha_nacimiento) {
            $campo_completarsql_1.=",fecha_nacimiento";
            $campo_completarsql_2.=",'$fecha_nacimiento'";
        }
        if (!isset($id_pais))
            $id_pais = '1';

        if ($id_estado) {
            $campo_completarsql_1.=",id_estado";
            $campo_completarsql_2.=",'$id_estado'";
        }
        if ($id_ciudad) {
            $campo_completarsql_1.=",id_ciudad";
            $campo_completarsql_2.=",'$id_ciudad'";
        }
        if ($id_grupo == '1') {
            $cupo = '9999999';
        } else {
            $cupo = '';
        }

        if ($id_grupo == '4')
            $cupo = '1';

        $this->db->query("INSERT INTO personas
												(identificacion,
												nombre,
												apellido,
												telefono,
												telefono2,
												correo,
												correo2,
												direccion,
												creado,
												modificado,
												fecha_creacion,
												fecha_modificacion,
												id_grupo,cupo,id_pais 
												$campo_completarsql_1)
											VALUES
												('$identificacion',
												'$nombre',
												'$apellido',
												'$telefono',
												'$telefono2',
												'$correo',
												'$correo2',
												'$direccion',
												'$creado',
												'$modificado',
												'$fecha_creacion',
												'$fecha_modificacion',
												'$id_grupo','$cupo','$id_pais'
												$campo_completarsql_2)");
        if (!$this->db->errno) {
            $this->msgTipo = "ok";
            $this->mensaje = "Se han agregado los datos correctamente...";
            $this->estatus = true;
            $this->json = json_encode($this);
            return $this->estatus;
        }
        if ($this->db->errno == 1062) {
            $this->msgTipo = "error";
            $this->mensaje = "El numero de identificacion ya existe y no puede ser editado a través de este modulo, por favor introduzca otra identificacion";
            $this->estatus = false;
            $this->json = json_encode($this);
            return $this->estatus;
        } else {
            $this->mensaje = "Disculpe, en este momento no se pudo agregar a la persona, por favor intente en otro momento o contacte a soporte tecnico.....INSERT INTO personas
												(identificacion,
												nombre,
												apellido,
												telefono,
												telefono2,
												correo,
												correo2,
												direccion,
												creado,
												modificado,
												fecha_creacion,
												fecha_modificacion,
												id_grupo
												$campo_completarsql_1)
											VALUES
												('$identificacion',
												'$nombre',
												'$apellido',
												'$telefono',
												'$telefono2',
												'$correo',
												'$correo2',
												'$direccion',
												'$creado',
												'$modificado',
												'$fecha_creacion',
												'$fecha_modificacion',
												'$id_grupo'
												$campo_completarsql_2)";
            $this->msgTipo = "error";
            $this->estatus = false;
            $this->json = json_encode($this);
            return $this->estatus;
        }
    }

    //********************************METODO CREADO PARA AGREGAR PERSONAS QUE POSEAN CODIGOS DE LIBROS*************
    public function agregar_codicionado($identificacion, $usuario, $grado, $cod_libro, $id_grupo, $clave, $reclave) {
        if (!$identificacion) {
            $this->mensaje = "El campo identificacion, es obligatorios...";
            $this->msgTipo = "aviso";
            $this->estatus = false;
            $this->json = json_encode($this);
            return $this->estatus;
        }
        if (!$usuario) {
            $this->mensaje = "Los campos con (*) son obligatorios...";
            $this->msgTipo = "aviso";
            $this->estatus = false;
            $this->json = json_encode($this);
            return $this->estatus;
        }
        if (!preg_match("/^[a-z]([0-9a-z_])+$/i", $usuario)) {
            $this->mensaje = "El nombre de usuario tiene que ser de minimo 2 caracteres contener solo letras, numeros y _";
            $this->msgTipo = "aviso";
            $this->estatus = false;
            $this->json = json_encode($this);
            return $this->estatus;
        }
        if (!$clave) {
            $this->mensaje = "Indique una clave, por favor...";
            $this->msgTipo = "aviso";
            $this->estatus = false;
            $this->json = json_encode($this);
            return $this->estatus;
        }
        if ($clave != $reclave) {
            $this->mensaje = "Las claves deben ser iguales...";
            $this->msgTipo = "aviso";
            $this->estatus = false;
            $this->json = json_encode($this);
            return $this->estatus;
        }


        $this->db = new db;
        $fecha_creacion = strtotime("now");

        $this->db->query("UPDATE codigo_libro SET estatus = '1', fec_adq = '$fecha_creacion' WHERE id_cod_libro ='$cod_libro'");
        $this->db->query("INSERT INTO personas
                                                (identificacion,nombre,apellido,
                                                direccion, telefono, telefono2, correo, correo2, modificado,
                                                fecha_modificacion,
                                                fecha_creacion,
                                                id_grupo,
                                                creado,
                                                id_cod_libro)
                                                VALUES ('$identificacion',' ',' ', ' ', ' ', ' ',' ',' ', ' ', '0',
                                                        '$fecha_creacion',                                                        
                                                        '$id_grupo',                                                        
                                                        '$creado',
                                                        $cod_libro)")or die("error");



        $ultima_persona = $this->db->query("SELECT LAST_INSERT_ID(id_persona) id_persona
                                                   FROM personas
                                                   ORDER BY 1 DESC
                                                   LIMIT 0,1")or die("error");


        $id_persona = $ultima_persona->fetch_assoc();
        $id_persona = $id_persona['id_persona'];
        /* $this->mensaje= $clave;
          $this->msgTipo="aviso";
          $this->estatus = true;
          $this->json=json_encode($this);
          return $this->estatus; */
        $user = new usuario;
        $user->registro_condicionado($id_persona, $id_grupo, $usuario, $clave);

        if ($user->estatus) {
            $this->mensaje = $user->mensaje;
            $carga_conf = $this->db->query("INSERT INTO usuarios_config (id_persona, grado, leccion_actual, id_libro)VALUES('$id_persona','$grado','0','$grado')");
            $this->estatus = $user->estatus;
            return $this->estatus;
        } else {
            
        }
    }

//************************************************************************************************************************
    public function editar($identificacion, $id_estado, $id_ciudad, $nombre, $apellido, $telefono, $telefono2, $correo, $correo2, $fecha_nacimiento, $direccion, $modificado, $id_grupo, $cod_libro) {
        if (!$nombre) {
            $this->mensaje = "El campo nombre, es obligatorios...";
            $this->msgTipo = "aviso";
            $this->estatus = false;
            $this->json = json_encode($this);
            return $this->estatus;
        }
        if (!$apellido) {
            $this->mensaje = "El campo apellido, es obligatorios...";
            $this->msgTipo = "aviso";
            $this->estatus = false;
            $this->json = json_encode($this);
            return $this->estatus;
        }
        if (!$telefono) {
            $this->mensaje = "El campo telefono, es obligatorios...";
            $this->msgTipo = "aviso";
            $this->estatus = false;
            $this->json = json_encode($this);
            return $this->estatus;
        }
        if (!$id_grupo)
            $grupo_completar = "";
        else
            $grupo_completar = ",id_grupo='$id_grupo'";

        if (!$this->listar($identificacion, "identificacion")) {//cambiar listar por encontrar
            $this->mensaje = "El numero de identificacion no existe en nuestra base de datos...";
            $this->msgTipo = "aviso";
            $this->estatus = false;
            $this->json = json_encode($this);
            return $this->estatus;
        }
        $this->db = new db;
        $fecha_modificacion = strtotime("now");

        $campo_completarsq1 = "";
        if ($fecha_nacimiento) {
            $campo_completarsql.=",fecha_nacimiento='$fecha_nacimiento'";
        }
        if ($id_estado) {
            $campo_completarsql.=",id_estado='$id_estado'";
        }
        if ($id_ciudad) {
            $campo_completarsql.=",id_ciudad='$id_ciudad'";
        }
        if ($cod_libro) {
            $campo_completarsql.=",id_cod_libro='$cod_libro'";
        }

        $this->db->query("UPDATE personas SET 
													nombre='$nombre',
													apellido='$apellido',
													telefono='$telefono',
													telefono2='$telefono2',
													correo='$correo',
													correo2='$correo2',
													direccion='$direccion',
													modificado='$modificado',
													fecha_modificacion='$fecha_modificacion'
													$grupo_completar
													$campo_completarsql
											WHERE identificacion='$identificacion'");

        if (!$this->db->errno) {
            if (isset($this->datos[0]['id_persona']) && ($id_grupo)) {
                $id_persona = $this->datos[0]['id_persona'];
                $usuarios = $this->db->query("SELECT * FROM usuarios WHERE id_persona='$id_persona'");
                if ($usuarios->num_rows) {
                    if ($cod_libro) {
                        $this->db->query("UPDATE codigo_libro SET estatus = '1', fec_adq = '$fecha_modificacion' WHERE id_cod_libro ='$cod_libro'");
                        $this->db->query("UPDATE  usuarios_config SET grado = $cod_libro  WHERE id_persona='$id_persona'");
                    }
                    $this->db->query("UPDATE usuarios SET id_grupo='$id_grupo' WHERE id_persona='$id_persona';");

                    if (!$this->db->errno) {
                        $this->msgTipo = "ok";
                        $this->mensaje = "Se han modificado los datos correctamente...";
                        $this->estatus = true;
                        $this->json = json_encode($this);
                        return $this->estatus;
                    } else {
                        $this->mensaje = "Error al intentar modificar los datos de este usuario...";
                        $this->msgTipo = "error";
                        $this->estatus = false;
                        $this->json = json_encode($this);
                        return $this->estatus;
                    }
                }
            }
            $this->msgTipo = "ok";
            $this->mensaje = "Se han modificado los datos correctamente...";
            $this->estatus = true;
            $this->json = json_encode($this);
            return $this->estatus;
        }
        $this->mensaje = "Disculpe, en este momento no se pudo guardar los datos introducidos, por favor intente en otro momento o contacte a soporte tecnico...";
        $this->msgTipo = "error";
        $this->estatus = false;
        $this->json = json_encode($this);
        return $this->estatus;
    }

    //*************************************************************************************************************
    public function eliminar($id_persona, $id_grupo = "") {
        if (!$id_persona) {
            $this->mensaje = "El Id_persona es necesario para realizar esta operación";
            $this->msgTipo = "error";
            $this->estatus = false;
            $this->json = json_encode($this);
            return $this->estatus;
        }
        $this->db = new db;
        $this->db->query("DELETE FROM personas WHERE id_persona='$id_persona'");
        if (!$this->db->errno) {
            $this->msgTipo = "ok";
            $this->mensaje = "Se han eliminado los datos correctamente...";
            $this->estatus = true;
            $this->json = json_encode($this);
            return $this->estatus;
        }
        $this->mensaje = "Disculpe, en este momento no se pudo eliminar los datos, por favor intente en otro momento o contacte a soporte tecnico";
        $this->msgTipo = "error";
        $this->estatus = false;
        $this->json = json_encode($this);
        return $this->estatus;
    }

//************************************************************************************************************	
    public function agregar_escuela_persona($id_persona, $nuevo_escuela) {
        if (!$id_persona) {
            $this->mensaje = "Todos los campos son obligatorios para poder asignar una escuela a una persona";
            $this->msgTipo = "aviso";
            $this->estatus = false;
            $this->json = json_encode($this);
            return $this->estatus;
        }
        if (isset($nuevo_escuela))
            foreach ($nuevo_escuela as $campo => $id_escuela) {

                $this->db->query("INSERT INTO personas_escuelas
														(id_persona,
														 id_escuela)
													VALUES
														('$id_persona',
														 '$id_escuela')");
                if ($this->db->errno == 1062) {
                    $this->msgTipo = "error";
                    $this->mensaje = "La parsona seleccionada ya es profesor de una de las escuelas seleccionas, esto quiere decir que se encuentra repetida o no es valida, intente de nuevo cambiando dicha escuela";
                    $this->estatus = false;
                    $this->json = json_encode($this);
                    return $this->estatus;
                }
                if ($this->db->errno) {
                    $this->msgTipo = "error";
                    $this->mensaje = "Se ha producido un error al tratar de guardar los datos de las escuelas ...";
                    $this->estatus = false;
                    $this->json = json_encode($this);
                    return $this->estatus;
                }
            }
        if (!$this->db->errno) {
            $this->msgTipo = "ok";
            $this->mensaje = "Se han guardado los datos correctamente...";
            $this->estatus = true;
            $this->json = json_encode($this);
            return $this->estatus;
        }
        $this->mensaje = "Disculpe, en este momento no se pudo guardar los datos introducidos, por favor intente en otro momento o contacte a soporte tecnico";
        $this->msgTipo = "error";
        $this->estatus = false;
        $this->json = json_encode($this);
        return $this->estatus;
    }

    //***************************************************************************************************************
    public function guardar_configuracion($identificacion, $id_estado, $id_ciudad, $nombre, $apellido, $telefono, $telefono2, $correo, $correo2, $fecha_nacimiento, $direccion, $modificado, $id_escuela = NULL, $id_profesor_seleccionado = NULL) {
        /* if(!$identificacion || !$id_estado || !$id_ciudad || !$fecha_nacimiento)
          {
          $this->mensaje="Los campos con * deben ser llenados para poder realizar esta operación. Recuerde, para poder disfrutar de este sistema, usted debe llenar todos los campos requeridos";
          $this->msgTipo="aviso";
          $this->estatus = false;
          $this->json=json_encode($this);
          return $this->estatus;
          } */
        //validar que todas las variables requeridas esten llenas
        if (!$this->encontrar($identificacion)) {
            $this->mensaje = "El numero de identificacion no existe en nuestra base de datos...";
            $this->msgTipo = "aviso";
            $this->estatus = false;
            $this->json = json_encode($this);
            return $this->estatus;
        }
        $id_persona = $this->datos;
        $this->db = new db;
        $fecha_modificacion = strtotime("now");

        $campo_completarsq1 = "";

        if ($fecha_nacimiento)
            $campo_completarsql.=",fecha_nacimiento='$fecha_nacimiento'";
        else
            $campo_completarsql.=",fecha_nacimiento=NULL";

        if ($id_estado)
            $campo_completarsql.=",id_estado='$id_estado'";
        else
            $campo_completarsql.=",id_estado=NULL";

        if ($id_ciudad)
            $campo_completarsql.=",id_ciudad='$id_ciudad'";
        else
            $campo_completarsql.=",id_ciudad=NULL";

        $this->db->query("UPDATE personas SET 
													nombre='$nombre',
													apellido='$apellido',
													telefono='$telefono',
													telefono2='$telefono2',
													correo='$correo',
													correo2='$correo2',
													direccion='$direccion',
													modificado='$modificado',
													fecha_modificacion='$fecha_modificacion'
													$campo_completarsql
											WHERE identificacion='$identificacion'");


        if (!$identificacion || !$id_estado || !$id_ciudad || !$nombre || !$apellido || !$telefono || !$correo || !$fecha_nacimiento || !$direccion) {
            $this->db->query("UPDATE usuarios_config SET 
													datos_actualizados='0'
											WHERE id_persona='$id_persona'"); //deberia buscar por el id_persona que deberia pasarlo en el llamado de la funcion
            $_SESSION[SISTEMA]['datos_actualizados'] = '0';
            $this->mensaje = "Los campos con * deben ser llenados para poder realizar esta operación. Recuerde, para poder disfrutar de Washington School, usted debe llenar todos los campos requeridos";
            $this->msgTipo = "aviso";
            $this->estatus = false;
            $this->json = json_encode($this);
            return $this->estatus;
        }

        $usuario_config = $this->db->query("SELECT * FROM usuarios_config WHERE id_persona='$id_persona'");
        //**************************lo que viene es porque los valores pueden ser null y no puedo meter estos valores en la bd


        if (!$id_escuela)
            $id_escuela = "NULL";
        else
            $id_escuela = "'$id_escuela'";

        if (!$id_profesor_seleccionado)
            $id_profesor_seleccionado = "NULL";
        else
            $id_profesor_seleccionado = "'$id_profesor_seleccionado'";

        //**************************************************

        if ($usuario_config->num_rows)//si el usuario ya ha tenido configuracion alguna vez, quiere decir que ya ha tenido contrato.. entonces se modifican los datos
            $this->db->query("UPDATE usuarios_config SET datos_actualizados='1',id_escuela=$id_escuela,  id_profesor_seleccionado=$id_profesor_seleccionado WHERE id_persona='$id_persona'");
        else//sino se inserta un nuevo registro de configuracion
            $this->db->query("INSERT INTO usuarios_config(id_persona,datos_actualizados,id_escuela,id_profesor_seleccionado)
																		VALUES
																		('$id_persona','1',$id_escuela,$id_profesor_seleccionado)");

        if (!$this->db->errno) {
            $_SESSION[SISTEMA]['datos_actualizados'] = '1';
            $this->msgTipo = "ok";

            $this->mensaje = "Se han guardado los datos correctamente. Ya puedes disfrutar de Washington School...";
            $this->estatus = true;
            $this->json = json_encode($this);
            return $this->estatus;
        }
        $this->mensaje = "Disculpe, en este momento no se pudo guardar los datos introducidos, por favor intente en otro momento o contacte a soporte tecnico";
        $this->msgTipo = "error";
        $this->estatus = false;
        $this->json = json_encode($this);
        return $this->estatus;
    }

    //***********************************************************************************************************
    public function listar($valor = "", $campo = "", $limite = "") {//el id persona puede ser un vector, la identificacion no.
        $this->db = new db;
        if (is_array($valor)) {//si id_persona es un vector
            $cadena = "$campo='$valor[0]'";
            foreach ($valor as $vector_campo => $vector_valor)//se listan las personas que estan en el vector id_persona
                if ($vector_campo > 0)
                    $cadena = " OR $vector_campo='$vector_valor'";
            $personas = $this->db->query("SELECT * FROM vpersonas WHERE $cadena ORDER BY nombre");
        }
        else
        if (!$valor && !$campo) {//si id_persona e identificacion estan vacios, entonces se listan todas las personas de la tabla
            if ($limite)
                $limite = " LIMIT $limite";
            $personas = $this->db->query("SELECT * FROM vpersonas ORDER BY nombre$limite");
        } else//sino entonces se busca la persona a por medio del campo id_persona o el campo identificacion
            $personas = $this->db->query("SELECT * FROM vpersonas WHERE $campo='$valor'");




        if (!$personas->num_rows) {
            $this->json = "";
            $this->mensaje = "No se encontraron registros...";
            $this->msgTipo = "aviso";
            $this->estatus = false;
            $this->json = json_encode($this);
            return $this->estatus;
        }
        $this->datos = "";

        while ($persona = $personas->fetch_assoc()) {
            $persona['fecha_nacimiento'] = fecha($persona['fecha_nacimiento']);
            $this->datos[] = $persona;
        }

        $this->json = "";
        $this->mensaje = "Se mostraron las personas correctamente...";
        $this->msgTipo = "ok";
        $this->estatus = true;
        $this->json = json_encode($this);
        return $this->estatus;
    }

    //***********************************************************************************************************
    public function listar_profesores($id_escuela = "") {
        $this->msgTitle = "Listar ciudades";
        $this->db = new db;
        if (is_array($id_escuela)) {
            $cadena = "id_escuela='$id_escuela[0]'";
            foreach ($id_escuela as $campo => $valor)
                if ($campo > 0)
                    $cadena = " OR id_escuela='$valor'";
            $profesores = $this->db->query("SELECT * FROM vpersonas_escuelas WHERE $cadena ORDER BY nombre_profesor");
        }
        else
        if (!$id_escuela)
            $profesores = $this->db->query("SELECT * FROM vpersonas_escuelas ORDER BY nombre_profesor");
        else
            $profesores = $this->db->query("SELECT * FROM vpersonas_escuelas WHERE id_escuela='$id_escuela' ORDER BY nombre_profesor");

        if ($profesores->num_rows == 0) {
            $this->mensaje = "No se encontraron profesores...";
            $this->msgTipo = "aviso";
            $this->estatus = false;
            $this->json = json_encode($this);
            return $this->estatus;
        }
        $this->datos = $profesores->all();
        $this->mensaje = "Se mostraron los profesores correctamente...";
        $this->msgTipo = "ok";
        $this->estatus = true;
        $this->json = json_encode($this);
        return $this->estatus;
    }

    //************************************************************************************************************
    /* public function encontrar_profesor_estudiante($id_persona)
      {
      $this->db = new db;
      $personas=$this->db->query("SELECT * FROM usuarios_extra WHERE id_persona='$id_persona'");
      if($personas->num_rows==0)
      {
      $this->mensaje = "El estudiante no tiene escuela asignada...";
      $this->msgTipo = "aviso";
      $this->estatus = false;
      $this->json = json_encode($this);
      return $this->estatus;
      }
      $this->mensaje = "El estudiante si tiene escuela asignada...";
      $this->msgTipo = "ok";
      $this->estatus = true;
      $this->json = json_encode($this);
      return $this->estatus;

      } */
    //************************************************************************************************
    /* public function guardar_profesor_estudiante($id_persona,$id_escuela,$id_profesor_seleccionado,$id_libro)
      {
      $this->db= new db;
      if($this->encontrar_profesor_estudiante($id_persona))
      $this->db->query("UPDATE usuarios_extra SET id_escuela='$id_escuela', id_profesor_seleccionado='$id_profesor_seleccionado',id_libro='$id_libro' WHERE id_persona='$id_persona'");
      else
      $this->db->query("INSERT INTO usuarios_extra (id_persona,id_escuela,id_profesor_seleccionado,id_libro) VALUES ('$id_persona','$id_escuela','$id_profesor_seleccionado,'$id_libro'')");

      if(!$this->db->errno)
      {

      $this->msgTipo="ok";
      $this->mensaje="Se han guardado los datos correctamente";
      $this->estatus = true;
      $this->json=json_encode($this);
      return $this->estatus;
      }
      $this->mensaje="Disculpe, en este momento no se pudo guardar los datos introducidos, por favor intente en otro momento o contacte a soporte tecnico";
      $this->msgTipo="error";
      $this->estatus = false;
      $this->json=json_encode($this);
      return $this->estatus;


      } */
    //***********************************************************************************************************
    public function encontrar($identificacion) {
        $this->msgTitle = "persona- encontrar persona";
        $this->db = new db;
        $lista = $this->db->query("SELECT * FROM personas WHERE identificacion='$identificacion' ");
        if (!$lista->num_rows) {
            $this->datos = "no se encontrado";
            $this->mensaje = "No se encontraron registros...";
            $this->msgTipo = "aviso";
            $this->estatus = false;
            return $this->estatus;
        }
        $list = $lista->fetch_assoc();
        $this->datos = $list['id_persona'];
        $this->mensaje = "Se ha encontrado la persona buscada...";
        $this->msgTipo = "ok";
        $this->estatus = true;
        return $this->estatus;
    }

    //***************************************************
    public function buscar_like($buscar, $id_grupo, $limite = "") {
        
    }

}

/* $persona =  new persona;
  $persona->listar("1234","identificacion");
  echo "<textarea>".print_r($persona->datos,true)."</textarea>"; */
?>