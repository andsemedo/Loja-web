<?php
if (!session_start()) {

    session_start();
}

$codCliente = '';
require_once('../includes/header.php');

use classes\Database\Database;

$bd = new Database();
$codCliente = '';
if (isset($_SESSION['codCliente'])) {
    $codCliente = $_SESSION['codCliente'];
}


$mensagem = '';
if (isset($_GET['mensagem']) == 'sucesso') {
    $mensagem = "<div class='alert alert-success m-auto' style='width: 300px;'>Encomenda feito com sucesso</div>";
}

$encomenda = $bd->select("SELECT DISTINCT p.nomeProduto, p.imagem, ep.quantidade, ep.preco_total, e.status_entrega  FROM encomenda e
JOIN encomenda_produtos ep ON ep.encomenda_id = e.id
JOIN produto p ON p.codProduto = ep.produto_id
JOIN cliente c ON e.cliente = '$codCliente'");
?>

<main>

    <?= $mensagem?>

    <div class="categoria-title">
        <h2 class="nomeCategoria">Minhas encomendas</h2>
    </div>

    <div class="container ">
        <div class="row justify-content-start">
            <div class="col-lg-10">

                <table class="table table-light table-borderless table-hover text-center mb-0 dados-produtos">
                    <thead class="thead-dark">
                        <tr>
                            <th>Produtos</th>
                            <th>Quantidade</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle ">
                        <?php
                        if($encomenda) {
                        foreach ($encomenda as $enc) {
                            ?>
                        <tr class="dados-produtos">
                            <td class="align-middle text-start"><img class="ms-0" src="../Imagens/<?=$enc->imagem?>" style="width: 50px;"> <?=$enc->nomeProduto?> </td>
                            <td class="align-middle"> <?=$enc->quantidade?> </td>
                            <td class="align-middle"> <?=number_format($enc->preco_total, 2, ',', '.')?> </td>
                            <td class="align-middle">
                                <?php
                                    if($enc->status_entrega == '0') {
                                        echo "Pendente";
                                    } else {
                                        echo "Entregue";
                                    }
                                ?>
                            </td>
                        </tr>
                        <?php 
                            }
                        } else {
                            echo "<tr>
                                <td colspan='4' style='font-weight: 600;'>Nenhuma encomenda para mostrar</td>
                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>

</main>