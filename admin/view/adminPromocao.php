<?php

use classes\Database\Database;

require_once("../../vendor/autoload.php");

$sql = "SELECT pm.idPromo, pd.imagem, pd.nomeProduto, pm.desconto, pm.valorPromo, pm.dtInicio, pm.dtFim
        FROM promocao pm
        JOIN produto pd ON pm.idProd = pd.codProduto
        ORDER BY pm.idPromo DESC";

$bd = new Database();
$promocoes = $bd->select($sql);

?>

<section class="main-container">

    <h1>Produtos em promoção</h1>

    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-modal">Adicionar</button>

    <table class="tabela">
        <thead>
            <tr>
                <th>Código</th>
                <th>Imagem</th>
                <th>Produto</th>
                <th>Desconto</th>
                <th>Valor promoção</th>
                <th>Data Início</th>
                <th>Data Fim</th>
                <th colspan="2">Ações</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <?php
                if ($promocoes) {
                    foreach ($promocoes as $promo) {
                ?>
                        <td><?= $promo->idPromo; ?></td>
                        <td><img height="100px" src="../Imagens/<?= $promo->imagem; ?>" alt="" /></td>
                        <td><?= $promo->nomeProduto; ?></td>
                        <td><?= $promo->desconto; ?></td>
                        <td><?= $promo->valorPromo; ?></td>
                        <td><?= $promo->dtInicio; ?></td>
                        <td><?= $promo->dtFim; ?></td>
                        <td colspan="3">
                            <span class="material-icons-outlined" style="color: blue;" onclick="editarPromocaoForm('<?= $promo->idPromo; ?>')">edit</span>
                            <span class="material-icons-outlined" style="color: red;" onclick="deletePromocao('<?= $promo->idPromo; ?>')">delete</span>
                        </td>
            </tr>
    <?php
                    }
                } else {
                    echo "<tr>
                            <td colspan = '8' style='font-weight: 600;'>Nenhum registro encontrado!</td>
                        </tr>";
                }
    ?>

        </tbody>
    </table>

    <div class="modal fade" id="add-modal" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Adicionar Promoção</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label>Produto: </label>
                        <select id="produto" class="form-select" required>
                            <option disabled selected>Selecione um produto</option>
                            <?php
                            $cod = 0;
                            $sql = '';
                            if(!empty($promocoes)) {
                                $sql = "SELECT DISTINCT p.codProduto, p.nomeProduto, p.preco FROM produto p, promocao pr WHERE p.codProduto != pr.idProd;";
                            } else {
                                $sql = "SELECT * FROM produto;";
                            }
                            $produtos = $bd->select($sql);
                            foreach ($produtos as $prod) {
                            ?>
                                <option value='<?= $prod->codProduto;  ?>'><?= $prod->nomeProduto . ' - ' . number_format($prod->preco, 2, ',', '.') ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Desconto: </label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="desconto" required>
                            <span class="input-group-text bg-grey">CVE</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Data início: </label>
                        <input type="date" class="form-control" id="data_ini">
                    </div>

                    <div class="form-group">
                        <label>Data fim: </label>
                        <input type="date" class="form-control" id="data_fim">
                    </div>

                    <div class="form-group">
                        <button type="submit" onclick="addPromocao()" class="btn btn-success mt-3">Adicionar</button>
                    </div>
                </div>
            </div>

        </div>
    </div>


</section>