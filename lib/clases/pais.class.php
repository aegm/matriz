<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class pais {

    protected $db;
    public $datos;
    public $estatus;

    public function __construct() {
        $this->db = new db;
    }

    public function listar() {
        $sql = "select * from pais";
        $query = $this->db->query($sql);
        if ($query->num_rows) {
            while ($pais = $query->fetch_assoc()) {
                $this->datos[] = $pais;
            }
            $this->estatus = true;
        }

        return $this->estatus;
    }

}
