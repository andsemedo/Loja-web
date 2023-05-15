<?php

use classes\Carrinho;

require_once("../vendor/autoload.php");



if(isset($_POST['adicionar-carrinho'])) {
    $prod = $_POST['cod_prod'];
    $preco_prod = $_POST['preco_prod'];

    Carrinho::addCarrinho($prod, $preco_prod);

    unset($_POST['adicionar-carrinho']);
    unset($_POST['cod_prod']);
    unset($_POST['preco_prod']);

}