<?php

use classes\Categoria;

require_once("../../../vendor/autoload.php");

if(isset($_POST['submit'])) {
    $nome = $_POST["nome"];

   Categoria::addCategoria($nome);

}


?>