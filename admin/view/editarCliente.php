<?php
require_once("../../vendor/autoload.php");

use classes\Database\Database;

$cliente_id = $_POST['record'];

$bd = new Database();

$clientes = $bd->select("SELECT c.codCliente, c.nome, u.email, c.telefone, e.localidade, e.ilha, u.username, u.pass, u.tipo, u.foto, c.endereco, c.user
FROM cliente c
JOIN utilizador u ON c.user = u.id
JOIN endereco e ON c.endereco = e.codEndereco
WHERE codCliente = '$cliente_id' ");

$bd = new Database();


foreach ($clientes as $cliente) {

?>

    <section class="main-container">
        <div class="edit-form ms-4">

            <h2 style="margin-bottom: 10px;">Editar Cliente</h2>

            <form enctype="multipart/form-data" action="javascript:editarProdutoForm()" onsubmit="atualizarCliente()" method="POST">

                <label for="codigo" class="form-label">Código: </label><br>
                <input type="text" size="50" class="form-control" name="codigo" id="codigo" value="<?= $cliente_id ?>" disabled><br>


                <label for="nome" class="form-label">Nome: </label><br>
                <input type="text" size="50" class="form-control" name="nome" id="nome" value="<?= $cliente->nome ?>"><br>


                <label for="email" class="form-label">Email: </label><br>
                <input type="mail" size="50" class="form-control" name="email" id="email" value="<?= $cliente->email ?>"><br>


                <label for="telefone" class="form-label">Telefone: </label><br>
                <input type="tel" class="form-control" name="telefone" id="telefone" value="<?= $cliente->telefone ?>"><br>

                <label for="ilha" class="form-label">Ilha</label><br>
                <select name="ilha" id="ilha" class="form-select">
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

                <label for="localidade" class="form-label">Localidade: </label><br>
                <input type="text" class="form-control" name="localidade" id="localida" value="<?= $cliente->localidade ?>"><br>

                <label for="username" class="form-label">Username: </label> <br>
                <input type="text" class="form-control" name="username" id="username" value="<?= $cliente->username ?>"><br>


                <label for="senha" class="form-label">Senha: </label> <br>
                <input type="text" class="form-control" name="senha" id="senha" value="<?= $cliente->pass ?>"><br>



                <label for="foto" class="form-label">Foto: </label><br>
                <input type="text" class="form-control" name="foto" id="foto" value="<?= $cliente->foto ?>"><br>
                <input type="file" class="form-control" name="novaFoto" id="novaFoto"><br>


            <?php
        };
            ?>


            <br>
            <input type="button" class="btn btn-secondary" onclick="todosClientes()" value="Voltar">
            <input class="btn btn-success" type="submit" name="submit" id="submit" value="Atualizar">
        </div>
        </form>

        </div>
    </section>