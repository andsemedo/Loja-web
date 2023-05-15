<?php

use classes\Tipo;

require_once("../../../vendor/autoload.php");


if(isset($_POST['submit'])) {
    $tipo = $_POST["tipo"];


    Tipo::addTipo($tipo);
}


?>