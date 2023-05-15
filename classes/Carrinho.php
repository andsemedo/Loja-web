<?php

namespace classes;
use classes\Database\Database;


class Carrinho {

    public function addCarrinho($id_prod, $preco, $qtd) {
        $preco = doubleval($preco);
        intval($qtd);
        $preco_total = $preco * $qtd;

        $bd = new Database();

        $result = $this->isInCart($id_prod);

        if($result) {
            $sql = "UPDATE carrinho SET qtd = qtd + $qtd WHERE id_prod = '$id_prod' ";
            $bd->query($sql);
        } else {
            $sql = "INSERT INTO carrinho (id_prod, qtd, preco_total) 
                VALUES ('$id_prod', '$qtd', '$preco_total'); ";

            $bd->query($sql);
        }

        
    }

    public function isInCart($id){
        
        $bd = new Database();

        $result = $bd->select("SELECT id_prod FROM carrinho WHERE id_prod = $id");

        if(!$result) {
            return false;
        } 
        return true;
    }

    public static function deleteCarrinho($id) {
        $bd = new Database();
        $sql = "DELETE FROM carrinho WHERE id_prod = '$id';";

        $bd->query($sql);
    }

    public static function atualizarCarrinho($id_prod, $qtd, $preco) {

        $sql = "UPDATE carrinho SET qtd = '$qtd', preco_total = $preco WHERE id_prod = '$id_prod' ";

        $bd = new Database();

        $bd->query($sql);

        return true;
    }

    // public static function adicionar_carrinho($id_prod, )
}