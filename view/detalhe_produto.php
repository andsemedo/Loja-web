<?php

use classes\Produto;

require_once('../includes/header.php');
if (isset($_GET['id_prod'])) {
    $id_prod = $_GET['id_prod'];
    $produto = Produto::detalhesProd($id_prod);
}
?>
<main>
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 bg-light mb-30">
                <?php
                foreach ($produto as $prod) {
                ?>
                    <div>
                        <img class="w-100 h-100" src="../Imagens/<?=$prod->imagem?>" alt="Image">
                    </div>
            </div>
            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 p-5" style="background: #282828;">

                    <h3><?= $prod->nomeProduto ?></h3>
                    <h3 class="font-weight-semi-bold mb-4"><?= number_format($prod->preco, 2, ',', '.') ?></h3>
                    <p class="mb-4"><?= $prod->descricao ?></p>
                
                <div class="d-flex flex-column align-items-start mb-4 pt-2">
                    <div class="input-group d-flex flex-row align-items-center mr-3 mb-3" style="width: 211px;">
                        <label for="addQtd" class="fw-bolder">Quantidade</label>
                        <input type="number" size="10" class="form-control border-0 ms-4 rounded-1 text-center fs-5 right" style="background: rgb(250,100,20); color: #fff;" id="addQtd" min="1" value="1">
                    </div>

                    <button class="btn btn-info px-3 d-flex flex-row content-center" style="height: 44px; font-weight: 600" onclick="adicionar_carrinho_qtd(<?=$prod->codProduto?>)">
                        <span class="material-icons-outlined mr-1">shopping_cart</span> Adicionar ao carrinho
                    </button>
                    <?php } ?>
                </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php

require_once('../includes/footer.php');
?>