<?php
require_once("../../vendor/autoload.php");

use classes\Database\Database;

$id_promo = $_POST['id_promo'];

$bd = new Database();

$promocao = $bd->select("SELECT * FROM promocao pr, produto p WHERE idPromo = '$id_promo' AND pr.idProd = p.codProduto");

foreach ($promocao as $promo) {

?>

    <section class="main-container ms-3">
        <div class="edit-form">

            <h2 style="margin-bottom: 10px;">Editar Promocao</h2>

            <input type="hidden" id="codigo" value="<?= $promo->idPromo ?>">
            <input type="hidden" id="preco" value="<?= $promo->preco ?>">

            <label for="produto" class="form-label">Produto: </label>

            <input type="text" class="form-control bg-grey" id="produto" value="<?= $promo->nomeProduto ?>" readonly>


            <label for="desconto" class="form-label">Desconto: </label>
            <input type="number" class="form-control" min="0.00" step="0.01" id="desconto" value="<?= $promo->desconto ?>">


            <label for="data_ini" class="form-label">Data inicio: </label>
            <input type="date" min="1" class="form-control" id="data_ini" value="<?= $promo->dtInicio ?>">

            <label for="data_fim" class="form-label">Data fim: </label>
            <input type="date" min="1" class="form-control" id="data_fim" value="<?= $promo->dtFim ?>">


        <?php
    };
        ?>

        <input type="button" class="btn btn-secondary mt-3" onclick="todasPromocoes()" value="Voltar">
        <input class="btn btn-success mt-3" type="submit" onclick="atualizarPromocao()" value="Atualizar">




        </div>
    </section>