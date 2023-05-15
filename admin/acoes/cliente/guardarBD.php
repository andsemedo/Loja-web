<?php

use classes\Cliente;
use classes\Endereco;
use classes\Utilizador;

require_once("../../../vendor/autoload.php");

if (isset($_POST['submit'])) {
    $nome = $_POST["nome"];
    $telefone = $_POST["telefone"];
    $email = $_POST["email"];
    $localidade = $_POST["localidade"];
    $municipio = $_POST["municipio"];
    $ilha = $_POST["ilha"];
    $username = $_POST["username"];
    $password = $_POST["pass"];
    $nif = $_POST["nif"];

    $foto = 'no_photo.png';

    if (isset($_FILES["foto"])) {
        $foto = $_FILES["foto"]['name'];
        $temp_foto = $_FILES["foto"]['tmp_name'];

        $diretorio = "../../../Imagens/";
        $fotoFinal = $diretorio . $foto;

        move_uploaded_file($temp_foto, $fotoFinal);
    }



    $tpUtilizador = Utilizador::tipoCliente();

    Utilizador::addUtilizador($username, $email, $password, '3', $foto);

    $user = Utilizador::lastId();

    Endereco::addEndereco($localidade, $ilha, $municipio,);

    $endereco = Endereco::lastId();

    Cliente::addCliente($nome, $telefone, $endereco, $user, $nif);
}
