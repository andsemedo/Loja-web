<?php

use classes\Cliente;

require_once("../../vendor/autoload.php");

$cliente_id = $_POST['record'];

$cliente = Cliente::detalhesCliente($cliente_id);

?>

<section class="main-container">
    <div class="container-detalhes">

        <?php
        foreach($cliente as $cli) {
        ?>
        <div class="detalhes-grid">
            <img src="../Imagens/<?=$cli->foto?>" alt="">
            <h2><?=$cli->nome?></h2>
        </div>
        <label><span>Código:</span> <?=$cli->codCliente?></label><br>
        <label><span>Nome:</span> <?=$cli->nome?></label><br>
        <label><span>Email:</span> <?=$cli->email?></label><br>
        <label><span>Telefone:</span> <?=$cli->telefone?></label><br>
        <label><span>Username:</span> <?=$cli->username?></label><br>
        <label><span>Senha:</span> <?=$cli->pass?></label><br>
        
        <?php
        }
        ?>

        <button class="btn btn-secondary" onclick="todosClientes()">Voltar</button>
    </div>
</section>