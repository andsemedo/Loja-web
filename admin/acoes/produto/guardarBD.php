<?php
require_once("../../../vendor/autoload.php");

use classes\Produto;
if(isset($_POST['submit'])) {
    $nome = $_POST["nome"];
    $preco = $_POST["preco"];
    $categoria = $_POST["categoria"];
    $stock = $_POST["quantidade"];
    $descricao = $_POST["descricao"];
            
    $imagem = $_FILES["imagem"]['name'];
    $temp_imagem = $_FILES["imagem"]['tmp_name'];

    $diretorio = "../../../Imagens/";
    $imagemFinal = $diretorio.$imagem;

    move_uploaded_file($temp_imagem, $imagemFinal);

    Produto::addProduto($nome, $descricao, $categoria, $preco, $stock, $imagem);
}


?>