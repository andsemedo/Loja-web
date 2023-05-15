<?php

namespace classes;

use classes\Database\Database;

class Promocao
{
    private $id;
    private $desconto;

    public static function addPromocao($id_prod, $desconto, $valorPromo, $dtInicio, $dtFim){

        $sql = "INSERT INTO promocao (idProd, desconto, valorPromo, dtInicio, dtFim) VALUES ('$id_prod', '$desconto', '$valorPromo', '$dtInicio', '$dtFim')";
        
        $bd = new Database();
        $bd->query($sql);

    }

    public static function updatePromocao($id_promo, $desconto, $valorPromo, $dtInicio, $dtFim){

        $sql = "UPDATE promocao SET desconto = '$desconto', valorPromo = '$valorPromo', dtInicio = '$dtInicio', dtFim = '$dtFim' WHERE idPromo = '$id_promo'";
        
        $bd = new Database();
        $bd->query($sql);

    }

    public static function removePromocao($id_promo) {
        $sql = "DELETE FROM promocao WHERE idPromo = '$id_promo' ";

        $bd = new Database();
        $bd->query($sql);
    }
}