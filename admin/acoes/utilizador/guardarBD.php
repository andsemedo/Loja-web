<?php

use classes\Funcionario;
use classes\Utilizador;

require_once("../../../vendor/autoload.php");

if(isset($_POST['submit'])) {
    $nome = $_POST["nome"];
    $telefone = $_POST["telefone"];
    $nif = $_POST["nif"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $tpUtilizador = $_POST["tpUtilizador"];
    $morada = $_POST["morada"];
    $descricao = $_POST["descricao"];

    $foto = 'no_photo.png';

    if (isset($_FILES["foto"])) {
        $foto = $_FILES["foto"]['name'];
        $temp_foto = $_FILES["foto"]['tmp_name'];

        $diretorio = "../../../Imagens/";
        $fotoFinal = $diretorio . $foto;

        move_uploaded_file($temp_foto, $fotoFinal);
    }

    Utilizador::addUtilizador($username, '', $password, $tpUtilizador, $foto);
    $user = Utilizador::lastId();

    Funcionario::addFuncionario($nome, $telefone, $nif, $morada, $user);
}


?>