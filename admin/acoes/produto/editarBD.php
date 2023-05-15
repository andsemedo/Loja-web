<?php

require_once("../../../vendor/autoload.php");

use classes\Produto;

if(isset($_POST['submit'])) {
    $id = $_POST['codigo'];
    $nome = $_POST["nome"];
    $preco = $_POST["preco"];
    $categoria = $_POST["categoria"];
    $stock = $_POST["quantidade"];
    $descricao = $_POST["descricao"];
    
    if( isset($_FILES['novaImagem']) ){
        
        $imagem = $_FILES["novaImagem"]['name'];
        $temp_imagem = $_FILES["novaImagem"]['tmp_name'];
        $diretorio = "../../../Imagens/";

        $imagemFinal=$diretorio.$imagem;

        move_uploaded_file($temp_imagem, $imagemFinal);
        
    }else{
        $imagem=$_POST['imagem'];
    }

    Produto::atualizarProduto($nome, $descricao, $categoria, $preco, $stock, $imagem, $id);
}

?>