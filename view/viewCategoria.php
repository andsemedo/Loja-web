<?php

use classes\Database\Database;

require_once('../includes/header.php');

$bd1 = new Database();

$id_cat = '';
if(isset($_GET['id_cat'])) {
    $id_cat = $_GET['id_cat'];
}
$query = "SELECT p.codProduto, p.nomeProduto, p.preco, p.imagem, c.categoria 
            FROM produto p 
            JOIN categorias c ON p.categoria = c.id 
            WHERE c.id = '$id_cat';";
$produtos = $bd1->select($query);
$nomeCat = '';
foreach ($produtos as $prod) {
    $nomeCat = $prod->categoria;
}
?>

<main>



    <div class="categoria-title">
        <h2 class="nomeCategoria"><?= $nomeCat ?></h2>
    </div>

    <nav class="filtro-prod">
        <form action="">
            <label class="filtro">Filtrar por: </label>

            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="preco" id="maior_preco" value="maior_preco">
                <label class="form-check-label" for="maior_preco">Maior Preço</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="preco" id="menor_preco" value="menor_preco">
                <label class="form-check-label" for="menor_preco">Menor Preço</label>
            </div>
        </form>
    </nav>

    <section class="section-categoria">
        <div class="col-lg-9 col-md-9 ms-5">
            <div class="row pb-3" style="width: 1200px;">
                <?php
                foreach ($produtos as $prod) {
                ?>
                    <div class="col-lg-3 col-lg-3 ms-0 mb-5">
                    <a href="./detalhe_produto.php?id_prod=<?=$prod->codProduto?>">
                        <div class="card" style="width: 260px; height: 380px;">
                            <div class="image-content">

                                <div class="card-image">
                                    
                                    <img src="../Imagens/<?= $prod->imagem ?>" alt="" class="card-img">
                                    
                                </div>
                            </div>

                            <div class="card-content">
                                <h3 class="name"><?= $prod->nomeProduto ?></h3>
                                <h4 class="preco"><?= number_format($prod->preco, 2, ',', '.') ?>&nbsp;CVE</h4>

                                <div class="div-add-cart">
                                </a>
                                    <button class="btn btn-info btn-sm" onclick="adicionar_carrinho(<?= $prod->codProduto ?>)">
                                        <span class="material-icons-outlined">shopping_cart</span>
                                        Adicionar ao carrinho
                                    </button>

                                    <!-- <button class="btn btn-icon">
                                    <span class="material-icons-outlined" >favorite</span>
                                    </button> -->

                                </div>
                            </div>
                        </div>

                    </div>
                <?php } ?>
            </div>
        </div>




    </section>



</main>

<?php
require_once('../includes/footer.php');
?>