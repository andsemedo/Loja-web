<?php

require_once("../vendor/autoload.php");

use classes\Database\Database;
use classes\Endereco;

$bd = new Database();

if (isset($_POST['acao']) == 'encomenda') {
    $id_cliente = $_POST['id_cliente'];
    $local = $_POST['local'];
    $ilha = $_POST['ilha'];
    $municipio = $_POST['municipio'];
    $count = $_POST['count'];

    $i = 0;

    $cliente = $bd->select("SELECT endereco FROM cliente WHERE codCliente = '$id_cliente' ");

    foreach ($cliente as $cli) {
        $endereco = $cli->endereco;
        if ($endereco == null) {
            Endereco::addEndereco($local, $ilha, $municipio);
            $last_end = Endereco::lastId();

            $bd->query("UPDATE cliente SET endereco = '$last_end' WHERE codCliente = '$id_cliente' ");
        } else {
            Endereco::updateEndereco($local, $ilha, $municipio, $id_cliente);
        }
    }

    $bd->query("INSERT INTO encomenda (status_pag, status_entrega, cliente) VALUES ('1', '0', '$id_cliente')");

    $res = $bd->select("SELECT id FROM encomenda ORDER BY id DESC");

    $last_id = $res[0]->id;

    echo $last_id;

    while ($i < $count) {
        $id = 'id_' . $i;
        $qtd = 'qtd_' . $i;
        $tt = 'total_' . $i;
        $prod_id = $_POST[$id];
        $prod_qtd = $_POST[$qtd];
        $total = $_POST[$tt];

        $bd->query("INSERT INTO encomenda_produtos (encomenda_id, produto_id, quantidade, preco_total) VALUES ('$last_id', '$prod_id', '$prod_qtd', '$total')");

        $i++;
    }

}
