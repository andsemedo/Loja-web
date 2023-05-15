<?php
require_once("../../vendor/autoload.php");
use classes\Database\Database;

$user_id = $_POST['record'];

$bd = new Database();

$utilizadores = $bd->select("SELECT f.user, f.nomeFunc, f.telefone, f.morada, u.username, u.pass, u.foto, t.tipo FROM utilizador as u
JOIN funcionario as f ON u.id = f.user
JOIN tipoutilizador as t ON u.tipo = t.id WHERE f.user = '$user_id';");

$bd = new Database();


foreach ($utilizadores as $utilizador) {
$tipoUser = $utilizador->tipo;

?>

<section class="main-container">
    <div class="edit-form">

        <h2 style="margin-bottom: 10px;">Editar Utilizador</h2>

        <form enctype="multipart/form-data" action="javascript:editarProdutoForm()" onsubmit="atualizarUtilizador()" method="POST">
            <div>
                <label>Código: </label><br>
                <input type="text" size="50" name="codigo" id="codigo" value="<?=$user_id?>"><br>
            </div>
            <div>
                <label>Nome: </label><br>
                <input type="text" size="50" name="nome" id="nome" value="<?=$utilizador->nomeFunc?>"><br>
            </div>
            <div>
                <label>Telefone: </label><br>
                <input type="tel" name="telefone" id="telefone" value="<?=$utilizador->telefone?>"><br>
            </div>
            <div>
                <label>Morada: </label><br>
                <input type="text" name="morada" id="morada" value="<?=$utilizador->morada?>"><br>
            </div>
            <div>
                <label>Username: </label> <br>
                <input type="text" name="username" id="username" value="<?=$utilizador->username?>" ><br>
            </div>
            <div>
                <label>Senha: </label> <br>
                <input type="text" name="pass" id="pass" value="<?=$utilizador->pass?>" ><br>
            </div>
            <div>
                        <label>Tipo Utilizador: </label><br>
                        
                        <select name="tpUtilizador" id="tpUtilizador" >
                        <?php
                            $tipoUtilizador = $bd->select("SELECT * FROM tipoutilizador WHERE tipo = '$tipoUser' ");
                            
                            foreach ($tipoUtilizador as $user => $value) {
                                echo "<option value='$value->id'>$value->tipo</option>";
                            }
                        ?>
                        <?php
                            $tipoUtilizador = $bd->select("SELECT * FROM tipoutilizador WHERE tipo != '$tipoUser' ");
                            
                            foreach ($tipoUtilizador as $user => $value) {
                                if($value->tipo != 'Cliente') {
                                echo "<option value='$value->id'>$value->tipo</option>";
                                };
                            }
                        ?>
                        </select>
                        
                    </div>
            <div>
                <label for="file">Foto: </label><br>
                <input type="text" name="foto" id="foto" value="<?=$utilizador->foto?>"><br>
                <input type="file" name="novaFoto" id="novaFoto" ><br>
            </div>

            <?php
            };
            ?>

            <div>
                <input class="btn" type="submit" name="submit" id="submit" value="Atualizar" >
            </div>
        </form>

    </div>
</section>