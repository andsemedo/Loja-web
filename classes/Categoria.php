<?php

namespace classes;

use classes\Database\Database;

class Categoria
{

    private $id;
    private $categoria;

    public function getId() {
        return $this->id;
    }
    public function setId($id) {
        $this->id = $id;
    }
    
    public function getCategoria() {
        return $this->categoria;
    }
    public function setCategoria($categoria) {
        $this->categoria = $categoria;
    }


    public static function addCategoria($categoria) {
        $sql = "INSERT INTO categorias (categoria) VALUES ('$categoria')";

        $bd = new Database();
        $bd->query($sql);
    }

}