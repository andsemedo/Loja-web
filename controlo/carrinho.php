<?php
session_start();

use classes\Carrinho;
use classes\Database\Database;
use classes\Produto;

require_once("../vendor/autoload.php");

$bd = new Database();

if (isset($_GET['acao']) == 'add_cart') {

    $id_prod = $_GET['id'];
    $qtd;

    if (isset($_GET['qtd'])) {
        $qtd = $_GET['qtd'];
    } else {
        $qtd = 1;
    }

    $preco_prod;
    $nome_prod;
    $imagem_prod;
    $nome_prod;
    $preco_total;

    $produto = Produto::detalhesProd($id_prod);

    foreach ($produto as $prod) {
        $preco_prod = $prod->preco;
        $nome_prod = $prod->nomeProduto;
        $imagem_prod = $prod->imagem;
    }

    $preco_total = intval($qtd) * intval($preco_prod);

    if (isset($_SESSION["carrinho"])) {
        $item_array_id = array_column($_SESSION["carrinho"], "item_id");
        if (!in_array($id_prod, $item_array_id)) {
            $count = count($_SESSION["carrinho"]);
            $item_array = array(
                'item_id'          =>    $id_prod,
                'item_nome'        =>    $nome_prod,
                'item_preco'       =>    $preco_prod,
                'item_total'       =>    $preco_total,
                'item_quantidade'  =>    $qtd,
                'item_imagem'      =>    $imagem_prod
            );
            $_SESSION["carrinho"][$count] = $item_array;
        } else {
            echo '<script>alert("Item Already Added")</script>';
        }
    } else {
        $item_array = array(
            'item_id'          =>    $id_prod,
            'item_nome'        =>    $nome_prod,
            'item_preco'       =>    $preco_prod,
            'item_total'       =>    $preco_total,
            'item_quantidade'  =>    $qtd,
            'item_imagem'      =>    $imagem_prod
        );
        $_SESSION["carrinho"][0] = $item_array;
    }
}

if (isset($_GET['remover'])) {

    $id = $_GET['remover'];

    foreach ($_SESSION["carrinho"] as $keys => $values) {
        if ($values["item_id"] == $id) {
            unset($_SESSION["carrinho"][$keys]);
            header("location: ../view/carrinho.php");
            exit;
        }
    }

    // 
}

if (isset($_POST['acao']) == 'atualizar') {
    $qtd = (int) $_POST['qtd'];
    $prod_id = $_POST['id'];
    $preco = $_POST['preco'];


    foreach ($_SESSION["carrinho"] as $keys => $values) {
        if ($values["item_id"] == $prod_id) {
            $_SESSION["carrinho"][$keys]['item_total'] = $preco;
            $_SESSION["carrinho"][$keys]['item_quantidade'] = $qtd;
            // $values['item_quantidade'] = $qtd;
            header("location: ../view/carrinho.php");
            exit;
        }
    }

}

if(isset($_GET['item'])) {
    $item = 0;
    
    if(isset($_SESSION['carrinho'])) {
        $item = count($_SESSION['carrinho']);
    }

    echo $item;
}
