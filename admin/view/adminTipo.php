<?php

use classes\Database\Database;

require_once("../../vendor/autoload.php");

$sql = "SELECT * FROM tipoutilizador";

$bd = new Database();
$tipoUtilizadores = $bd->select($sql);
?>


<section class="main-container">

    <h1>Tipo Utilizador</h1>

    <button class="btn btn-primary" id="add">Adicionar</button>

    <form action="javascript:tiposUtilizadores()" class="formCat" id="formTipo" method="POST" onsubmit="addTipo()">
        <input type="text" size="40" name="tipo" id="tipo" class="inputCategoria" placeholder="Nome: " required>
        <input class="btn btn-adicionar" type="submit" name="submit" id="submit" value="Adicionar">
    </form>

    <table class="tabela">
        <thead>
            <tr>
                <th>Código</th>
                <th>Tipo</th>
                <th colspan="2">Ações</th>
            </tr>
        </thead>

        <tbody>

            <?php
            if($tipoUtilizadores) { 
            foreach ($tipoUtilizadores as $tipo) {
            ?>
            <tr>
                <td><?=$tipo->id?></td>
                <td><?=$tipo->tipo?></td>
                <td colspan="2">
                <span class="material-icons-outlined" style="color: blue;" onclick="editarTipoForm('<?= $tipo->id; ?>')">edit</span>
                <span class="material-icons-outlined" style="color: red;" onclick="deleteTipo('<?= $tipo->id; ?>')">delete</span>
                </td>
            </tr>
            <?php
                }
            } else {  
                echo "<tr>
                        <td colspan = '3' style='font-weight: 600;'>Nenhum registro encontrado!</td>
                    </tr>";
            }
            ?>
            
        </tbody>
    </table>

    <script>
        let btnTipo = document.getElementById('add');
        let form = document.getElementById('formTipo');

        
        btnTipo.onclick = function() {
            btnTipo.style.display = 'none';
            form.style.display = 'block';
        } 

    </script>


</section>