<?php

require_once("../vendor/autoload.php");

use classes\Cliente;

if (isset($_POST['username']) && isset($_POST['password'])) {
    echo "OK";

    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $result = Cliente::validaLogin($username, $password);

    print_r($result);

    session_start();

    if ($result) {
        foreach ($result as $res) {
            $_SESSION['id'] = $res->id;
            $_SESSION['codCliente'] = $res->codCliente;
            $_SESSION['username'] = $res->username;
            $_SESSION['pass'] = $res->pass;
            $_SESSION['foto'] = $res->foto;
            $_SESSION['tipo'] = $res->tipo;

            if(isset($_GET['acao'])) {
                $acao = $_GET['acao'];
                if( $acao == 'comprar') {
                    header('location: ../view/encomenda.php');
                    exit();
                } else {
                    header('location: ../index.php');
                    exit();
                }
            }
            
        }
    } else {
        header('location: ../view/login.php?login=errado');
        exit();
    }
}
else {
    echo "NOP";
}
