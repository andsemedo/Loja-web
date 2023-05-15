<?php

use classes\Database\Database;

require_once("../../../vendor/autoload.php");


if(isset($_POST['acao']) == "marcar_encomenda") {
    $id = $_POST['id_encomenda'];

    $sql = "UPDATE encomenda e SET e.status_entrega = '1' WHERE e.id = $id;";

    $bd = new Database();
    $bd->query($sql);

}

?>