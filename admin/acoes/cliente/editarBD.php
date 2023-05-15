<?php

use classes\Cliente;

require_once("../../../vendor/autoload.php");


if(isset($_POST['submit'])) {
    $id = $_POST['codigo'];
    $nome = $_POST["nome"];
    $telefone = $_POST["telefone"];
    $localidade = $_POST["localidade"];
    $username = $_POST["username"];
    $pass = $_POST["pass"];

    if( isset($_FILES['novaFoto']) ){
        
        $foto = $_FILES["novaFoto"]['name'];
        $temp_foto = $_FILES["novaFoto"]['tmp_name'];
        $diretorio = "../../../Imagens/";

        $fotoFinal=$diretorio.$foto;

        move_uploaded_file($temp_foto, $fotoFinal);
        
    }else{
        $foto=$_POST['foto'];
    }

    Cliente::editarCliente($id, $nome, $email, $telefone, $localidade, $rua, $numCasa, $username, $pass);

}

?>