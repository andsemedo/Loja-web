<?php

use classes\Database\Database;
use classes\Produto;

require_once("../../vendor/autoload.php");


$prod_id = $_POST['record'];

$produto = Produto::detalhesProd($prod_id);

?>

<section class="main-container">
    <div class="container-detalhes">

        <?php
        foreach($produto as $prod) {
        ?>
        <h2><?=$prod->nomeProduto?></h2>
        <div class="detalhes-grid">
            <img src="../Imagens/<?=$prod->imagem?>" alt="">
            <div>
                <h3>Preço: <?=$prod->preco?> CVE</h3>
            </div>
        </div>
        <p><?=$prod->descricao?></p>
        
        <?php
        }
        ?>

        <button class="btn btn-secondary" onclick="todosProdutos()">Voltar</button>
    </div>
</section>