<?php

require_once("../../../vendor/autoload.php");

use classes\Funcionario;
use classes\Utilizador;

if(isset($_POST['submit'])) {
    $id = $_POST['codigo'];
    $nome = $_POST["nome"];
    $telefone = $_POST["telefone"];
    $morada = $_POST["morada"];
    $username = $_POST["username"];
    $pass = $_POST["pass"];
    $tipo = $_POST['tpUtilizador'];

    if( isset($_FILES['novaFoto']) ){
        
        $foto = $_FILES["novaFoto"]['name'];
        $temp_foto = $_FILES["novaFoto"]['tmp_name'];
        $diretorio = "../../../Imagens/";

        $fotoFinal=$diretorio.$foto;

        move_uploaded_file($temp_foto, $fotoFinal);
        
    }else{
        $foto=$_POST['foto'];
    }

    Funcionario::atualizarUserFunc($id, $nome, $telefone, $morada, $username, $pass, $tipo, $foto);
}

?>