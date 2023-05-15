<?php
require_once("../../../vendor/autoload.php");
use classes\Produto;

    $prod_id = $_POST['record'];

    Produto::deleteProd($prod_id);
    

?>