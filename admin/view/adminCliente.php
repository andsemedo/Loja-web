<?php

use classes\Database\Database;

require_once("../../vendor/autoload.php");

$sql = "SELECT c.codCliente, c.nome, u.email, c.telefone, u.username, u.pass, u.tipo, u.foto, c.endereco, c.user
        FROM cliente c
        JOIN utilizador u ON c.user = u.id ";

$bd = new Database();
if(isset($_POST['Submeter'])){
    $nif = $_POST['pesquisar'];
    $sql = "SELECT c.codCliente, c.nome, u.email, c.telefone, c.Nif, u.username, u.pass, u.tipo, u.foto, c.endereco, c.user
    FROM cliente c, utilizador u
    WHERE c.Nif = '$nif' AND c.user = u.id ";
}

$clientes = $bd->select($sql);


?>


<section class="main-container">

    <h1>Clientes</h1>

    <button id="btnAdicionar" class="btn btn-primary">Adicionar</button>

    <table class="tabela">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Username</th>
                <th>Password</th>
                <th colspan="3">Ações</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <?php
                if ($clientes) {
                    foreach ($clientes as $cliente) {
                ?>
                        <td><img height="100px" src="../Imagens/<?= $cliente->foto ?>" alt="" /></td>
                        <td><?= $cliente->nome ?></td>
                        <td><?= $cliente->email ?></td>
                        <td><?= $cliente->username ?></td>
                        <td><?= $cliente->pass ?></td>
                        <td colspan="3">
                            <span class="material-icons-outlined" style="color: green;" onclick="detalhesCliente('<?= $cliente->user; ?>')">info</span>
                            <span class="material-icons-outlined" style="color: blue;" onclick="editarClienteForm('<?= $cliente->codCliente; ?>')">edit</span>
                            <span class="material-icons-outlined" style="color: red;" onclick="deleteCliente('<?= $cliente->codCliente; ?>')">delete</span>
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
                    <h4>Adicionar Cliente</h4>
                </center>
            </div>
            <!-- ./acoes/produto/guardarBD.php -->
            <div class="popup-body">
                <form enctype="multipart/form-data" action="javascript:todosClientes()" onsubmit="addCliente()" method="POST">
                    <div>
                        <label>Nome: </label><br>
                        <input type="text" size="50" name="nome" id="nome" required><br>
                    </div>

                    <div>
                        <label>Email: </label><br>
                        <input type="email" name="email" id="emila" ><br>
                    </div>
                    <div>
                        <label>Telefone: </label><br>
                        <input type="tel" name="telefone" id="telefone" required><br>
                    </div>

                    <div>
                        <label>Localidade: </label><br>
                        <input type="text" name="localidade" id="localidade" required><br>
                    </div>

                    <div>
                        <label>Municipio: </label><br>
                        <input type="text" name="municipio" id="municipio" required><br>
                    </div>

                    <div>
                        <label>Nif: </label><br>
                        <input type="text" name="nif" id="nif" required maxlength="9"><br>
                    </div>
                    

                    <div>
                        <label>Ilha: </label><br>
                        <select name="ilha" id="ilha" required>
                            <option selected disabled>Selecione uma ilha</option>
                            <option value="Boa Vista">Boa Vista</option>
                            <option value="Brava">Brava</option>
                            <option value="Fogo">Fogo</option>
                            <option value="Maio">Maio</option>
                            <option value="Sal">Sal</option>
                            <option value="São Nicolau">São Nicolau</option>
                            <option value="São Vicente">São Vicente</option>
                            <option value="Santiago">Santiago</option>
                            <option value="Santo Antão">Santo Antão</option>
                        </select>
                    </div>

                    <div>
                        <label>Username: </label><br>
                        <input type="text" name="username" id="username"><br>
                    </div>

                    <div>
                        <label>Password: </label><br>
                        <input type="password" name="pass" id="pass" required><br>
                    </div>

                    <div>
                        <label for="foto">Foto: </label><br>
                        <input type="file" name="foto" id="foto" style="border: none;"><br>
                    </div>

                    <div>
                        <center>
                            <input class="btn btn-success" type="submit" name="submit" id="submit" value="Adicionar">
                        </center>
                    </div>

                </form>
            </div>
        </div>
    </div>


    <script>
        // modal
        var ppCliente = document.getElementById('popup');

        var btnCliente = document.getElementById('btnAdicionar');

        var closeCliente = document.querySelector('.close');

        btnCliente.onclick = function() {
            ppCliente.style.display = 'block';
        }

        closeCliente.onclick = function() {
            ppCliente.style.display = 'none';
        }

        window.onclick = function(e) {
            if (e.target == ppCliente) {
                ppCliente.style.display = 'none';
            }
        }

        // Editar
    </script>


</section>