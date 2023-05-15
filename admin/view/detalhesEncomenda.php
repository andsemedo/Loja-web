<?php

use classes\Database\Database;
use classes\Produto;

require_once("../../vendor/autoload.php");


$id_encomenda = $_POST['id_encomenda'];

$sql = "SELECT DISTINCT ep.encomenda_id, ep.quantidade, ep.preco_total AS preco_total, p.codProduto, p.nomeProduto FROM encomenda_produtos ep JOIN encomenda e ON ep.encomenda_id = '$id_encomenda' JOIN produto p ON ep.produto_id = p.codProduto;";

$bd = new Database();
$encomenda = $bd->select($sql);

?>

<section class="main-container">
    <div class="container-detalhes" style="width: 800px; margin-left: -80px;">

        <h2>Produtos</h2>
        <?php
        $total = 0;
        foreach ($encomenda as $enc) {
            $total += $enc->preco_total;
        ?>
            <h5><span class="fw-bold" style="margin-right: 123px;">Item: </span><?= $enc->nomeProduto ?></h5>
            <h5><span class="fw-bold me-5">Quantidade: </span><?= $enc->quantidade ?></h5>
            <hr>
            <?php
        }
        ?>
        <h4><span class="fw-bold" style="margin-right: 94px;">TOTAL: </span> <?=number_format($total,2,',','.')?></h4>

        <button class="btn btn-secondary mt-3" onclick="todasEncomendas()">Voltar</button>
        <button class="btn btn-success mt-3" onclick="marcarEntregue(<?=$id_encomenda?>)">Marcar como entregue</button>
    </div>
</section>