<?php

    require_once("../../vendor/autoload.php");
    use classes\Database\Database;
    use classes\Produto;

    $bd = new Database();
    $produtos = $bd->select("SELECT * FROM produto ORDER BY codProduto DESC");
    $categorias = $bd->select("SELECT * FROM categorias");
    // echo "<pre>"; print_r($prod); echo "</pre>";
?>

<section class="main-container">

    <h1>Produtos</h1>

    <button class="btn btn-primary" id="btnAdicionar" >Adicionar</button>

    <table class="tabela">
        <thead>
            <tr>
                <th>Código</th>
                <th>Imagem</th>
                <th>Nome</th>
                <th>Categoria</th>
                <th>Preço</th>
                <th>Estoque</th>
                <th colspan="2">Ações</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <?php
                if($produtos) { 
                foreach ($produtos as $prod) {
                ?>
                <td><?=$prod->codProduto;?></td>
                <td><img height="100px" src="../Imagens/<?=$prod->imagem;?>" alt="" /></td>
                <td><?=$prod->nomeProduto;?></td>
                <td><?=$prod->categoria;?></td>
                <td><?=$prod->preco;?> CVE</td>
                <td><?=$prod->stock;?></td>
                <td colspan="2">
                    <span class="material-icons-outlined" style="color: green;" onclick="detalhesProdutos('<?=$prod->codProduto;?>');">info</span>
                    <span class="material-icons-outlined" style="color: blue;" onclick="editarProdutoForm('<?=$prod->codProduto;?>')">edit</span>
                    <span class="material-icons-outlined" style="color: red;" onclick="deleteProduto('<?=$prod->codProduto;?>')">delete</span>
                </td>
            </tr>

            <?php
                    }
                } else {  
                    echo "<tr>
                            <td colspan = '7' style='font-weight: 600;'>Nenhum registro encontrado!</td>
                        </tr>";
                }
            ?>
            
        </tbody>
    </table>

    <!-- Form adicionar produto -->
    <div id="popup" class="popup">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close">&times;</span>
                <center>
                    <h4>Adicionar Produto</h4><br>
                </center>
            </div>
            <!-- ./acoes/produto/guardarBD.php -->
            <div class="popup-body">
                <form enctype="multipart/form-data" action="javascript:todosProdutos()" onsubmit="addProduto()" method="POST">
                    <div>
                        <label>Nome: </label><br>
                        <input type="text" size="50" name="nome" id="nome" placeholder="Nome" required><br>
                    </div>
                    <div>
                        <label>Preço: </label><br>
                        <input type="number" min="0.00" step="0.01" name="preco" id="preco" required style='text-align: right; width: 370px'>
                        <label>CVE</label><br>
                    </div>
                    <div>
                        <label>Categoria: </label><br>
                        
                        <select name="categoria" id="categoria" required style='text-align: center;'>
                            <option disabled selected>Selecionar categoria</option>
                        <?php
                            foreach ($categorias as $cat => $value) {

                                echo "<option value='$value->id'>$value->categoria</option>";
                            }
                        ?>
                        </select><br>
                        
                    </div>
                    <div>
                        <label>Quantidade: </label><br>
                        <input type="number" min="1" name="quantidade" id="quantidade" required ><br>
                    </div>
                    <div>
                        <label>Descrição</label> <br>
                        <textarea name="descricao" cols="53" rows="5" id="descricao" required></textarea><br>
                    </div>
                    <div>
                        <label for="imagem">Imagem: </label><br>
                        <input type="file" name="imagem" id="imagem" required style="border: none;"><br><br>
                    </div>
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
        var ppProdutos = document.getElementById('popup');

        var btnProd = document.getElementById('btnAdicionar');

        var closeProd = document.querySelector('.close');

        btnProd.onclick = function () {
            ppProdutos.style.display = 'block';
        }

        closeProd.onclick = function () {
            ppProdutos.style.display = 'none';
        }

        window.onclick = function (e) {
            if(e.target == ppProdutos) {
                ppProdutos.style.display = 'none';
            }
        }

        // Editar

    </script>

</section>

<!--  -->