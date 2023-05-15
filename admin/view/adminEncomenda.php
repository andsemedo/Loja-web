<?php

use classes\Database\Database;

require_once("../../vendor/autoload.php");

session_start();

$sql = "SELECT e.id, e.data, e.status_pag, e.status_entrega, c.nome
        FROM encomenda e
        JOIN cliente c ON e.cliente = c.codCliente";

$bd = new Database();
$encomendas = $bd->select($sql);


?>

<section class="main-container">

    <h1>Encomendas</h1>


    <table class="tabela">
        <thead>
            <tr>
                <th>Código</th>
                <th>Cliente</th>
                <th>Data</th>
                <th>Status pagamento</th>
                <th>Status entrega</th>
                <th colspan="2">Ações</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <?php
                if ($encomendas) {
                    foreach ($encomendas as $encomenda) {
                ?>
                        <td><?= $encomenda->id; ?></td>
                        <td><?= $encomenda->nome; ?></td>
                        <td><?= $encomenda->data; ?></td>
                        <td>
                            <?php
                            if ($encomenda->status_pag == '0') {
                                echo 'Não Pago';
                            } else {
                                echo 'Pago';
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            if ($encomenda->status_entrega == '0') {
                                echo 'Não Entregue';
                            } else {
                                echo 'Entregue';
                            }
                            ?>
                        </td>
                        <td colspan="3">
                            <span class="material-icons-outlined" style="color: green;" onclick="detalhesEncomenda('<?= $encomenda->id; ?>')">info</span>
                        </td>
            </tr>
    <?php
                    }
                } else {
                    echo "<tr>
                            <td colspan = '11' style='font-weight: 600;'>Nenhum registro encontrado!</td>
                        </tr>";
                }
    ?>

        </tbody>
    </table>

    


</section>