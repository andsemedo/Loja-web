<?php

require_once("../vendor/autoload.php");

use classes\Cliente;

if (isset($_POST['registrar'])) {

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $conf_password = $_POST['conf_password'];

    if($password == $conf_password) {
        Cliente::criarConta($nome, $email, $telefone, $username, $password);
        header("location: ../view/login.php");
    } else {
        header("location: ../view/registrar.php?error=pass");
        exit;
    }

    
}
