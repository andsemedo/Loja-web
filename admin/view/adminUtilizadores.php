<?php

use classes\Database\Database;

require_once("../../vendor/autoload.php");

$sql = "SELECT f.user, f.nomeFunc, u.username, u.pass, u.foto, t.tipo FROM utilizador as u
        JOIN funcionario as f ON u.id = f.user
        JOIN tipoutilizador as t ON u.tipo = t.id ";

$bd = new Database();
$utilizadores = $bd->select($sql);

$tipoUtilizador = $bd->select("SELECT * FROM tipoutilizador");

?>


<section class="main-container">

    <h1>Utilizadores</h1>

    <button id="btnAdicionar" class="btn btn-primary">Adicionar</button>

    <table class="tabela">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Nome</th>
                <th>Username</th>
                <th>Password</th>
                <th>Tipo</th>
                <th colspan="3">Ações</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <?php
                if($utilizadores) { 
                foreach($utilizadores as $user) {
                ?>
                <td><img height="100px" src="../Imagens/<?=$user->foto?>" alt="" /></td>
                <td><?=$user->nomeFunc?></td>
                <td><?=$user->username?></td>
                <td><?=$user->pass?></td>
                <td><?=$user->tipo?></td>
                <td colspan="3">
                    <span class="material-icons-outlined" style="color: green;" onclick="detalhesUtilizador('<?=$user->user;?>')" >info</span>
                    <span class="material-icons-outlined" style="color: blue;" onclick="editarUtilizadorForm('<?=$user->user;?>')" >edit</span>
                    <span class="material-icons-outlined" style="color: red;" onclick="deleteUtilizador('<?=$user->user;?>')">delete</span>
                </td>
                
            </tr>
            <?php
                    }
                } else {  
                    echo "<tr>
                            <td colspan = '6' style='font-weight: 600;'>Nenhum registro encontrado!</td>
                        </tr>";
                }
            ?>
            
        </tbody>
    </table>


    <div id="popup" class="popup">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close">&times;</span>
                <center>
                    <h4>Adicionar Utilizador</h4>
                </center>
            </div>
            <!-- ./acoes/produto/guardarBD.php -->
            <div class="popup-body">
                <form enctype="multipart/form-data" action="javascript:todosUtilizadores()" onsubmit="addUtilizador()" method="POST">
                    <div>
                        <label>Nome: </label><br>
                        <input type="text" size="50" name="nome" id="nome" required><br>
                    </div>

                    <div>
                        <label>Telefone: </label><br>
                        <input type="tel" maxlength="7" name="telefone" id="telefone" required ><br>
                    </div>

                    <div>
                        <label>NIF: </label><br>
                        <input type="number" name="nif" id="nif" required ><br>
                    </div>

                    <div>
                        <label>Morada: </label><br>
                        <input type="text" name="morada" id="morada" required ><br>
                    </div>

                    <div>
                        <label>Username: </label><br>
                        <input type="text" name="username" id="username" required ><br>
                    </div>

                    <div>
                        <label>Password: </label><br>
                        <input type="password" name="password" id="password" required ><br>
                    </div>

                    <div>
                        <label>Tipo Utilizador: </label><br>
                        
                        <select name="tpUtilizador" id="tpUtilizador" required style='text-align: center;'>
                            <option disabled selected>Selecionar tipo utilizador</option>
                        <?php
                            foreach ($tipoUtilizador as $user => $value) {
                                if($value->tipo != 'Cliente') {
                                echo "<option value='$value->id'>$value->tipo</option>";
                                };
                            }
                        ?>
                        </select><br>
                        
                    </div>
                    
                        <label for="foto">Foto: </label><br>
                        <input type="file" name="foto" id="foto" style='border: none;'><br>

                    <div>
                        <center>
                            <input class="btn btn-success" type="submit" name="submit" id="submit" value="Adicionar" >
                        </center>
                    </div>

                </form>
            </div>
        </div>
    </div>

    
    <script>

        // modal
        var ppUser = document.getElementById('popup');

        var btnUser = document.getElementById('btnAdicionar');

        var closeUser = document.querySelector('.close');

        btnUser.onclick = function () {
            ppUser.style.display = 'block';
        }

        closeUser.onclick = function () {
            ppUser.style.display = 'none';
        }

        window.onclick = function (e) {
            if(e.target == ppUser) {
                ppUser.style.display = 'none';
            }
        }

        // Editar

    </script>


</section>