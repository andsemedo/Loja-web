<?php
require_once("../../../vendor/autoload.php");

use classes\Database\Database;
use classes\Promocao;

if(isset($_POST['acao']) == 'adicionar') {
    $produto = $_POST['produto'];
    $desconto = $_POST['desconto'];
    $data_ini = $_POST['data_ini'];
    $data_fim = $_POST['data_fim'];


    $bd = new Database();
    $res = $bd->select("SELECT preco FROM produto WHERE codProduto = '$produto' ");

    $preco = 0;
    foreach ($res as $key) {
        $preco = $key->preco;
    }

    $valorPromo = intval($preco) - intval($desconto); 

    Promocao::addPromocao($produto, $desconto, $valorPromo, $data_ini, $data_fim);

}

if(isset($_POST['acao']) == 'editar') {
    $id_promo = $_POST['id_promo'];
    $preco = $_POST['preco'];
    $desconto = $_POST['desconto'];
    $data_ini = $_POST['data_ini'];
    $data_fim = $_POST['data_fim'];


    $bd = new Database();

    $valorPromo = intval($preco) - intval($desconto); 

    Promocao::updatePromocao($id_promo, $desconto, $valorPromo, $data_ini, $data_fim);

}

if(isset($_POST['acao']) == 'remover') {
    $id_promo = $_POST['id_promo'];

    Promocao::removePromocao($id_promo);
}

?>