<?php

use classes\Database\Database;

require_once("../../vendor/autoload.php");

$sql = "SELECT * FROM categorias";

$bd = new Database();
$categorias = $bd->select($sql);

?>

<section class="main-container">

    <h1>Categorias</h1>

    <button class="btn btn-primary btnAdicionar" id="add">Adicionar</button>

    <form action="javascript:todasCategorias()" class="formCat" id="formCat" method="POST" onsubmit="addCategoria()">
        <input type="text" size="40" name="nome" id="nome" class="inputCategoria" placeholder="Nome: " required>
        <input class="btn btn-adicionar" type="submit" name="submit" id="submit" value="Adicionar">
    </form>


    <table class="tabela">
        <thead>
            <tr>
                <th>Código</th>
                <th>Categoria</th>
                <th colspan="2">Ações</th>
            </tr>
        </thead>

        <tbody>

            <?php
            if($categorias) { 
            foreach ($categorias as $categoria) {
            ?>
            <tr>
                <td><?=$categoria->id?></td>
                <td><?=$categoria->categoria?></td>
                <td colspan="2">
                    <span class="material-icons-outlined" style="color: blue;" onclick="editarCategoriaForm('<?= $categoria->id; ?>')">edit</span>
                    <span class="material-icons-outlined" style="color: red;" onclick="deleteCategoria('<?= $categoria->id; ?>')">delete</span>
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
        let form = document.getElementById('formCat');

        
        btnTipo.onclick = function() {
            btnTipo.style.display = 'none';
            form.style.display = 'block';
        } 

    </script>  


</section>