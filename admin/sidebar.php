


<div class="sidebar">
        
        <div class="side-content">
            <div class="profile">
                <div class="profile-img bg-img" style="background-image: url(../Imagens/<?=$foto;?>)"></div>
                <h4><?=$nome;?></h4>
                <small id="privilegio"><?=$tipo;?></small>
            </div>

            <div class="side-menu">
                <ul class="sidebar-links">
                    <li id="dashboard">
                       <a href="./index.php" class="sidebar-link" id="dash">
                            <span class="icons material-icons-outlined">home</span>
                            <small>Dashboard</small>
                        </a>
                    </li>
                    <li id="produtos">
                       <a href="#produtos" class="sidebar-link" onclick="todosProdutos()" onclick="changeBar()" >
                            <span class="icons material-icons-outlined">store</span>
                            <small>Produtos</small>
                        </a>
                    </li>
                    <li id="utilizadores">
                       <a href="#utilizadores" iclass="sidebar-link" onclick="todosUtilizadores()">
                            <span class="icons material-icons-outlined">person</span>
                            <small>Utilizadores</small>
                        </a>
                    </li>
                    <li id="clientes">
                       <a href="#clientes" class="sidebar-link" onclick="todosClientes()">
                            <span class="icons material-icons-outlined">people</span>
                            <small>Clientes</small>
                        </a>
                    </li>
                    <li id="encomendas">
                       <a href="#encomendas" class="sidebar-link" onclick="todasEncomendas()" >
                            <span class="icons material-icons-outlined">shopping_cart</span>
                            <small>Encomendas</small>
                        </a>
                    </li>
                    <li id="promocoes">
                       <a href="#promocoes" class="sidebar-link" onclick="todasPromocoes()">
                            <span class="icons material-icons-outlined">sell</span>
                            <small>Promoções</small>
                        </a>
                    </li>
                    <li id="categorias">
                       <a href="#categorias" class="sidebar-link" onclick="todasCategorias()">
                            <span class="icons material-icons-outlined">category</span>
                            <small>Categorias</small>
                        </a>
                    </li>
                    <li id="tipoUtilizador" >
                       <a href="#tipoUser" class="sidebar-link" onclick="tiposUtilizadores()">
                            <span class="icons material-icons-outlined">person</span>
                            <small>Tipo Utilizadores</small>
                        </a>
                    </li>
                </ul>
            </div>
        
            
            <?php

                switch ($tipo) {
                    case 'Vendedor':
                        echo "<script type='text/javascript'>
                                tipoUser = document.getElementById('tipoUtilizador');
                                categorias = document.getElementById('categorias');
                                utilizadores = document.getElementById('utilizadores');

                                tipoUser.style.display = 'none';
                                categorias.style.display = 'none';
                                utilizadores.style.display = 'none';
                            </script>";
                        break;

                    case 'Gestor':
                        echo "<script type='text/javascript'>
                                tipoUser = document.getElementById('tipoUtilizador');
                                categorias = document.getElementById('categorias');

                                tipoUser.style.display = 'none';
                                categorias.style.display = 'none';
                            </script>";
                        break;

                    case 'Administrador de Sistemas':
                        echo "<script type='text/javascript'>
                                promocoes = document.getElementById('promocoes');
                                encomendas = document.getElementById('encomendas');
                                produtos = document.getElementById('produtos');

                                promocoes.style.display = 'none';
                                encomendas.style.display = 'none';
                                produtos.style.display = 'none';
                            </script>";
                        break;

                    case 'Serviço de entrega':
                        echo "<script type='text/javascript'>
                                promocoes = document.getElementById('promocoes');
                                categorias = document.getElementById('categorias');
                                produtos = document.getElementById('produtos');
                                tipoUtilizador = document.getElementById('tipoUtilizador');
                                clientes = document.getElementById('clientes');
                                utilizadores = document.getElementById('utilizadores');
                                dashboard = document.getElementById('dashboard');

                                promocoes.style.display = 'none';
                                dashboard.style.display = 'none';
                                produtos.style.display = 'none';
                                categorias.style.display = 'none';
                                tipoUtilizador.style.display = 'none';
                                clientes.style.display = 'none';
                                utilizadores.style.display = 'none';

                                todasEncomendas();

                            </script>";
                        break;
                    
                    default:
                        # code...
                        break;
                }

            ?>

            
        

        </div>
    </div>
</div>