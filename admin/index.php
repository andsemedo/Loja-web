<?php

session_start();

if (isset($_GET['sessao_admin']) && $_GET['sessao_admin'] == 'terminar') {
    session_destroy();
    header('location: login.php');
    exit();
}

if (!isset($_SESSION['id_admin']) && !isset($_SESSION['tipo_admin'])) {
    if ($_SESSION['tipo_admin'] != 'Cliente') {

        header("location: login.php");
    }
}

$id = $_SESSION['id_admin'];
$username = $_SESSION['username'];
$pass = $_SESSION['pass_admin'];
$nome = $_SESSION['nome_admin'];
$foto = $_SESSION['foto_admin'];
$tipo = $_SESSION['tipo_admin'];


// if(isset($_POST['Submeter'])){
//     $nif = $_POST['pesquisar'];
//     $sql = "SELECT c.codCliente, c.nome, u.email, c.telefone, c.Nif, u.username, u.pass, u.tipo, u.foto, c.endereco, c.user
//     FROM cliente c, utilizador u
//     WHERE c.Nif = '$nif' AND c.user = u.id ";
// }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Admin</title>

    <link rel="stylesheet" href="./includes/css/style.css">
    <link rel="stylesheet" href="./includes/css/bootstrap.min.css">
    <link rel="stylesheet" href="./includes/icons/icons.css">


</head>

<body>

    <?php
    require_once("./adminHeader.php");
    require_once("./sidebar.php");
    require_once("../vendor/autoload.php");

    use classes\Cliente;
    use classes\Database\Database;
    use classes\Produto;

    $a = new Database();

    $totalClientes = Cliente::totalClientes();
    $totalProdutos = Produto::totalProdutos();

    ?>

    <section class="todos-conteudos">
        <section class="dash-container">
            <div class="linha">
                <div class="coluna">
                    <div class="cartao">

                        <span class="icon material-icons-outlined">people</span>
                        <h2>Total de Clientes</h2>
                        <h3 style="color: red;"><?= $totalClientes; ?></h3>

                    </div>
                </div>
            </div>
            <div class="linha">
                <div class="coluna">
                    <div class="cartao">

                        <span class="icon material-icons-outlined">people</span>
                        <h2>Total de Produtos</h2>
                        <h3 style="color: red;"><?= $totalProdutos; ?></h3>

                    </div>
                </div>
            </div>
            <div class="linha">
                <div class="coluna">
                    <div class="cartao">

                        <span class="icon material-icons-outlined">people</span>
                        <h2>Total de Encomendas</h2>
                        <h3 style="color: red;">5</h3>

                    </div>
                </div>
            </div>
        </section>
    </section>


    <script type="text/javascript" src="./includes/js/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="./includes/js/ajax.js"></script>
    <!-- <script type="text/javascript" src="./includes/js/login.js"></script> -->
    <script type="text/javascript" src="./includes/js/bootstrap.bundle.min.js"></script>
    <!-- <script type="text/javascript" src="./includes/js/script.js"></script> -->
</body>

</html>