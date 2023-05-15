<?php

use classes\Carrinho;
use classes\Database\Database;

    require_once("../vendor/autoload.php");
    
    $bd = new Database();
    $categorias = $bd->select("SELECT DISTINCT(c.id), c.categoria FROM categorias c 
                                JOIN produto p ON p.categoria = c.id;");

    
    if(!session_start()){
        session_start();
    }
    $lenght = 0;
    if(isset($_SESSION['carrinho'])) {
        $lenght = count($_SESSION['carrinho']);
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loja - Projeto Web</title>

    <link rel="stylesheet" href="../includes/css/bootstrap.min.css">
    <link rel="stylesheet" href="../includes/font-awesome/all.min.css">
    <link rel="stylesheet" href="../includes/icons/icons.css">

    <link rel="stylesheet" href="../includes/css/style.css">
    <link rel="stylesheet" href="../includes/css/estilocabecalho.css">
    <link rel="stylesheet" href="../includes/css/estiloRodape.css">
    <link rel="stylesheet" href="../includes/css/categoria.css">
    <link rel="stylesheet" href="../includes/css/home.css">
    <link rel="stylesheet" href="../includes/css/logo.css">
    <link rel="stylesheet" href="../includes/css/swiper-bundle.min.css">

</head>

<body>

<header>
        <nav>

            <a href="../view/home.php">
            <h2 class="logotipo">TEC<span class="tecKriolu">KRIOLU</span></h2>
            </a>

            <div id="barrapesquisa"><input type="text" placeholder="Pesquisar..." id="pesquisar" style="color: #fff;" autofocus></div>

            <div id="dropCat">
            <a href="#" class="dropCat" >Categorias</a>
            <div class="dropdown">
                <ul>
                    <?php
                        foreach ($categorias as $cat) {
                    ?>
                    <li><a href="viewCategoria.php?id_cat=<?=$cat->id;?>"><?=$cat->categoria;?></a></li>
                    <?php
                        }
                    ?>
                </ul>
            </div>
            </div>

            <div class="icons me-5">
                <!-- <div class="img"><span class="material-icons-outlined" style="font-size: 36px;">favorite</span></div> -->

                <div class="img">
                    <a href="../view/carrinho.php">
                        <span class="material-icons-outlined" style="font-size: 36px;">shopping_cart</span>
                        
                        <div class="badge" id="cart-item"></div>
                        
                    </a>
                </div>

                <div class="img drop-user">
                    <span class="material-icons-outlined person"  style="font-size: 36px;"> person_outline </span> 
                    <div class="dropdown-user" style="margin-left: -120px;" >
                        <ul>
                            <?php
                            if(isset($_SESSION['codCliente']) == false) {
                            ?>
                            <li><a href="login.php" class="d-flex flex-row align-items-center"><span class="material-icons-outlined">meeting_room</span>&nbsp;Login</a></li>
                            <li><hr></li>
                            <li><a href="registrar.php" class="d-flex flex-row align-items-center"><span class="material-icons-outlined">login</span>&nbsp;Registrar</a></li>
                            <?php
                            } else {
                            ?>
                            <li><a href="perfil.php" class="d-flex flex-row align-items-center"><span class="material-icons-outlined">manage_accounts</span>&nbsp;Perfil</a></li>
                            <li><hr></li>
                            <li><a href="minhas_encomendas.php" class="d-flex flex-row align-items-center"><span class="material-icons-outlined">manage_accounts</span>&nbsp;Minhas encomendas</a></li>
                            <li><hr></li>
                            <li><a href="home.php?sessao=terminar" class="d-flex flex-row align-items-center" style="color: rgb(228, 19, 19);"><span class="material-icons-outlined" style="color: rgb(228, 19, 19);">logout</span>&nbsp;Sair</a></li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>

                </div>
            </div>

        </nav>
    </header>

    

    <script >

        let dropCat = document.getElementById("dropCat");
        let dropdown = document.querySelector(".dropdown");

        let drop_user = document.querySelector(".drop-user");
        let dropdown_user = document.querySelector(".dropdown-user");

        dropCat.onmouseover = function() {
            dropdown.style.display = 'block';
        }

        dropCat.onmouseout = function() {
            dropdown.style.display = 'none';
        }

        drop_user.onmouseover = function() {
            dropdown_user.style.display = 'block';
        }

        drop_user.onmouseout = function() {
            dropdown_user.style.display = 'none';
        }

    </script>