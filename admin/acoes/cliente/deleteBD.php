<?php

use classes\Cliente;

require_once("../../../vendor/autoload.php");


    $cliente_id = $_POST['record'];

    Cliente::deleteCliente($cliente_id);
    

?>