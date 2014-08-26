<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '../../config.php';
require_once('dbi.class.php');
require_once('dbi.result.class.php');

class matriz {

    protected $db;

    public function __construct() {
        $this->db = new db;
    }

    public function positionActual() {
        //verificamos el tipo de matrix activa
        $sql = "SELECT
                    m.id,
                    c.valor1,
                    c.valor2
                FROM
                    matrix m,
                    config_matrix c
                WHERE
                    m.estatus = '1'
                AND m.id_config_matrix = c.id_matrix";
        $matrix = $this->db->query($sql);
        $datos = $matrix->fetch_assoc();
        $id = $datos['id'];
        $valor1 = $datos['valor1'];
        $valor2 = $datos['valor2'];
        $sql = "select * from linea where id_matrix = '$id' and  order by position asc";
        $query = $this->db->query($sql);
        if ($query->num_rows) {
            $linea = 1;
            while ($position = $query->fetch_assoc()) {
                if($position['linea'] == $linea)
            }
        }
    }

}

$matrix = new matriz;
$matrix->positionActual();
