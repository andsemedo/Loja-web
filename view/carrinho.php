<?php
if(!session_start()) {

    session_start();
}

require_once('../includes/header.php');

use classes\Database\Database;

$bd = new Database();

$codCliente = '';
if (isset($_SESSION['codCliente'])) {
    $codCliente = $_SESSION['codCliente'];
}

?>

<main>
    <div class="categoria-title">
        <h2 class="nomeCategoria">Carrinho</h2>
    </div>

    <div class="container ">
        <div class="row justify-content-start">
            <div class="col-lg-8">

                <table class="table table-light table-borderless table-hover text-center mb-0 dados-produtos">
                    <thead class="thead-dark">
                        <tr>
                            <th>Produtos</th>
                            <th>Preço</th>
                            <th>Quantidade</th>
                            <th>Total</th>
                            <th>Remover</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle ">
                        <?php
                        if (isset($_SESSION['carrinho'])) {
                            if (!empty($_SESSION['carrinho'])) {
                                // print_r($_SESSION['carrinho']);
                                foreach ($_SESSION['carrinho'] as $key => $value) {
                                    
                        ?>
                                    <tr class="dados-produtos">
                                        <td class="align-middle text-start"><img class="ms-0" src="../Imagens/<?= $value['item_imagem'] ?>" style="width: 50px;"> <?= $value['item_nome'] ?></td>
                                        <td class="align-middle">
                                            <?= number_format($value['item_preco'], 2, ',', '.') ?>
                                            <input type="hidden" name="preco" id="preco" value="<?= $value['item_preco'] ?>">
                                        </td>
                                        <td class="d-flex flex-row justify-content-center td-qtd align-items-center">
                                            <div class="input-group">
                                                <button class="input-group-text bg-danger border-0 btn-menos atualizarQtd" data-id='<?= $value['item_id'] ?>'>-</button>
                                                <input class="text-center border-0 fs-5 qtd-cart" disabled value="<?= $value['item_quantidade'] ?>">
                                                <button class="input-group-text bg-primary border-0 btn-mais atualizarQtd" data-id='<?= $value['item_id'] ?>'>+</button>
                                            </div>
                                        </td>
                                        <td class="align-middle"><?= number_format($value['item_total'], 2, ',', '.') ?>&nbsp;CVE</td>
                                        <td class="align-middle">
                                            <a class="btn btn-icon" href="../controlo/carrinho.php?remover=<?= $value['item_id'] ?>">
                                                <span class="material-icons-outlined" style="color: red;">delete</span>
                                            </a>

                                        </td>
                                    </tr>
                                <?php } ?>
                        <?php } else {
                                echo "<tr>
                                    <td colspan='5' style='font-weight: 600;'>Nenhum produto no carrinho</td>
                                </tr>";
                            }
                        } else {
                            echo "<tr>
                                <td colspan='5' style='font-weight: 600;'>Nenhum produto no carrinho</td>
                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>

            </div>
            <div class="col-lg-4">
                <form class="mb-30" action="">
                    <div class="input-group">

                    </div>
                </form>
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="pr-3">Resumo do carrinho</span></h5>
                <div class="p-30 mb-5" style="background: #fff;">
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2 ps-3 pe-3 div-total">
                            <h4>Total</h4>
                            <?php
                            $total = 0;
                            if(isset($_SESSION['carrinho'])) {
                                foreach ($_SESSION['carrinho'] as $key => $value) {
                                    $total += $value['item_total'];
                                }
                            }
                            ?>
                            <h4><?= number_format($total, 2, ',', '.')?>&nbsp;CVE</h4>
                        </div>
                        <div class="d-flex justify-content-center">
                            <a href="encomenda.php" class="btn btn-block btn-primary font-weight-bold my-3 py-3 btn-compra">Fazer a encomenda</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<?php
require_once('../includes/footer.php');
?>