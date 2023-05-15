<?

namespace classes;

class Funcoes
{
    public static function addProdutos() {
        $p_nome = $_POST["nome"];
        $p_preco = $_POST["preco"];
        $p_categoria = $_POST["categoria"];
        $p_quantidade = $_POST["quantidade"];
        $p_descricao = $_POST["descricao"];
        
        $p_imagem = $_FILES["imagem"]['name'];

        
        
    }

}