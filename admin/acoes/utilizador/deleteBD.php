<?php

use classes\Funcionario;

require_once("../../../vendor/autoload.php");


    $user_id = $_POST['record'];

    Funcionario::deleteFuncionario($user_id);

?>