<?php

use classes\Funcionario;

require_once("../../vendor/autoload.php");

$user_id = $_POST['record'];

$utilizador = Funcionario::detalhesFuncionario($user_id);

?>

<section class="main-container">
    <div class="container-detalhes">

        <?php
        foreach($utilizador as $user) {
        ?>
        <div class="detalhes-grid">
            <img src="../Imagens/<?=$user->foto?>" alt="">
            <h2><?=$user->nomeFunc?></h2>
        </div>
        <label><span>Código:</span> <?=$user->codFunc?></label><br>
        <label><span>Nome:</span> <?=$user->nomeFunc?></label><br>
        <label><span>Telefone:</span> <?=$user->telefone?></label><br>
        <label><span>NIF:</span> <?=$user->nif?></label><br>
        <label><span>Morada:</span> <?=$user->morada?></label><br>
        <label><span>Username:</span> <?=$user->username?></label><br>
        <label><span>Senha:</span> <?=$user->pass?></label><br>
        <label><span>Privilégio:</span> <?=$user->tipo?></label><br>

        <?php
        }
        ?>

        <button class="btn btn-secondary" onclick="todosUtilizadores()">Voltar</button>
    </div>
</section>