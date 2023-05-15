<?php

use classes\Database\Database;

require_once('../includes/header.php');

$bd = new Database();
$promocao = $bd->select("SELECT promo.idPromo, promo.valorPromo, prod.codProduto, prod.nomeProduto, prod.imagem, prod.preco FROM promocao promo JOIN produto prod ON prod.codProduto = promo.idProd;");

$destaques = $bd->select("SELECT * FROM produto LIMIT 5");

if(isset($_GET['sessao']) == 'terminar') {
    session_destroy();
}
?>


<main>

    <section>

        <div class="slide-container swiper">
            <div class="slide-content">
                <h1 class="titulo">Destaque</h1>

                <div class="card-wrapper swiper-wrapper">

                    <?php
                    foreach ($destaques as $prod) {
                    ?>
                        <div class="card swiper-slide">
                            <div class="image-content">

                                <div class="card-image">
                                    <img src="../Imagens/<?= $prod->imagem ?>" alt="" class="card-img">
                                </div>
                            </div>

                            <div class="card-content">
                                <h3 class="name"><?= $prod->nomeProduto ?></h3>
                                <h4 class="preco"><?= number_format($prod->preco, 2, ',', '.')  ?>&nbsp;CVE</h4>

                                <div class="div-add-cart">
                                    <button type="submit" class="btn btn-info btn-sm" onclick="adicionar_carrinho(<?= $prod->codProduto ?>)">
                                        <span class="material-icons-outlined">shopping_cart</span>
                                        Adicionar ao carrinho
                                    </button>
                                </div>
                            </div>
                        </div>

                    <?php
                    }
                    ?>


                </div>
            </div>

            <div class="swiper-button-next swiper-navBtn"></div>
            <div class="swiper-button-prev swiper-navBtn"></div>
            <div class="swiper-pagination"></div>
        </div>
    </section>

    <section>
        <div class="slide-container swiper">
            <div class="slide-content">
                <h1 class="titulo">Promoções</h1>
                <div class="card-wrapper swiper-wrapper">

                    <?php
                    foreach ($promocao as $promo) {
                    ?>

                        <div class="card swiper-slide">
                            <div class="image-content">

                                <div class="card-image">
                                    <img src="../Imagens/<?= $promo->imagem ?>" alt="" class="card-img">
                                </div>
                            </div>

                            <div class="card-content">
                                <h3 class="name"><?= $promo->nomeProduto ?></h3>
                                <div class="precos">
                                    <h4 class="preco"><?= number_format($promo->valorPromo, 2, ',', '.') ?>&nbsp;CVE</h4>
                                    <h5 class="preco-ant"><s class="precoant"><?= number_format($promo->preco, 2, ',', '.') ?>&nbsp;CVE</s> </h5>
                                </div>


                                <div class="div-add-cart">
                                    <button class="btn btn-info btn-sm" onclick="adicionar_carrinho(<?= $prod->codProduto ?>)">
                                        <span class="material-icons-outlined">shopping_cart</span>
                                        Adicionar ao carrinho
                                    </button>
                                </div>
                            </div>
                        </div>

                    <?php } ?>

                </div>
            </div>

            <div class="swiper-button-next swiper-navBtn"></div>
            <div class="swiper-button-prev swiper-navBtn"></div>
            <div class="swiper-pagination"></div>
        </div>
    </section>

</main>

<?php
require_once('../includes/footer.php');
?>