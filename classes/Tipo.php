<?php

namespace classes;

use classes\Database\Database;

class Tipo
{

    private $id;
    private $tipo;

    public static function addTipo($tipo) {
        $sql = "INSERT INTO tipoutilizador (tipo) VALUES ('$tipo')";

        $bd = new Database();
        $bd->query($sql);
    }

}