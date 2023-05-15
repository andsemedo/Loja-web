<?php
require_once("../../vendor/autoload.php");
use classes\Database\Database;

$prod_id = $_POST['record'];

$bd = new Database();

$produtos = $bd->select("SELECT * FROM produto WHERE codProduto = '$prod_id'");

foreach ($produtos as $prod) {
$cat_id = $prod->categoria;
    

?>

<section class="main-container ms-3">
    <div class="edit-form">

        <h2 style="margin-bottom: 10px;">Editar Produto</h2>

        <form enctype="multipart/form-data" action="javascript:editarProdutoForm()" onsubmit="atualizarProduto()" method="POST">
                <label for="codigo" class="form-label">Código: </label>
                <input type="text" size="5" class="form-control" name="codigo" id="codigo" value="<?=$prod->codProduto?>" disabled>

                <label for="nome" class="form-label">Nome: </label>
                <input type="text" size="50" class="form-control" name="nome" id="nome" value="<?=$prod->nomeProduto?>">

        
                <label for="preco" class="form-label">Preço: </label>
                <input type="number" class="form-control" min="0.00" step="0.01" name="preco" id="preco" value="<?=$prod->preco?>">
         
         
                <label for="categoria" class="form-label">Categoria: </label>
                
                <select name="categoria" class="form-select" id="categoria" >
                <?php
                    $categorias = $bd->select("SELECT * FROM categorias WHERE id='$cat_id'");
                    foreach ($categorias as $cat => $value) {

                        echo "<option value='$value->id'>$value->categoria</option>";
                    }
                ?>
                <?php
                    $categorias = $bd->select("SELECT * FROM categorias WHERE id!='$cat_id'");
                    foreach ($categorias as $cat => $value) {

                        echo "<option value='$value->id'>$value->categoria</option>";
                    }
                ?>
                </select>
      
        
                <label for="quantidade" class="form-label">Quantidade: </label>
                <input type="number" min="1" class="form-control" name="quantidade" id="quantidade" value="<?=$prod->stock?>">
      
            
                <label for="descricao" class="form-label">Descrição</label> <br>
                <textarea name="descricao" class="form-control" cols="30" rows="10" id="descricao" ><?=$prod->descricao?></textarea>
      
            
                <label for="imagem">Imagem: </label>
                <input type="text" class="form-control" name="imagem" id="imagem" value="<?=$prod->imagem?>">
                <input type="file" class="form-control" name="novaImagem" id="novaImagem" >
      

            <?php
            };
            ?>

                <br>
                <input type="button" class="btn btn-secondary" onclick="todosProdutos()" value="Voltar">
                <input class="btn btn-success" type="submit" name="submit" id="submit" value="Atualizar" >
            
        </form>

        

    </div>
</section>