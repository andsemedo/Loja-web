<?php

namespace classes;
use classes\Database\Database;


class Produto
{
    private $cod;
    private $nome;
    private $categoria;
    private $descricao;
    private $preco;
    private $stock;
    private $imagem;

    public function setCod($cod) {
        $this->cod = $cod;
    }
    public function getId() {
        return $this->cod;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }
    public function getNome() {
        return $this->nome;
    }

    public function setCategoria($categoria) {
        $this->categoria = $categoria;
    }
    public function getCategoria() {
        return $this->categoria;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }
    public function getDescricao() {
        return $this->descricao;
    }

    public function setPreco($preco) {
        $this->preco = $preco;
    }
    public function getPreco() {
        return $this->preco;
    }

    public function setStock($stock) {
        $this->stock = $stock;
    }
    public function getStock() {
        return $this->stock;
    }

    public function setImagem($imagem) {
        $this->imagem = $imagem;
    }
    public function getImagem() {
        return $this->imagem;
    }

    

    public static function addProduto($nome, $descricao, $categoria, $preco, $stock, $imagem) {

        $sql = "INSERT INTO produto (nomeProduto, descricao, categoria, preco, stock, imagem) VALUES ('$nome', '$descricao', '$categoria', '$preco', '$stock', '$imagem')";

        $bd = new Database();

        $bd->query($sql);
        
    }

    public static function atualizarProduto($nome, $descricao, $categoria, $preco, $stock, $imagem, $id) {

        $sql = "UPDATE produto SET nomeProduto='$nome', descricao='$descricao', categoria='$categoria', preco='$preco', stock='$stock', imagem='$imagem' WHERE codProduto='$id' ";


        $bd = new Database();

        $bd->query($sql);
        
    }

    public static function deleteProd($id) {

        $sql = "DELETE FROM produto WHERE codProduto = '$id' ";

        $bd = new Database();

        $dados = $bd->query($sql);
        if($dados){
            echo "Produto deletado";
        } else {
            echo "Não pode deletar";
        }
    }

    public static function detalhesProd($id) {

        $sql = "SELECT * FROM produto WHERE codProduto = '$id' ";

        $bd = new Database();

        return $bd->select($sql);
    }

    public static function totalProdutos() {
        $sql = "SELECT COUNT(codProduto) AS numProdutos FROM produto ";

        $bd = new Database();
        $result = $bd->select($sql);

        $qtd = 0;
        foreach ($result as $res) {
            $qtd = $res->numProdutos;
        }

        return $qtd;

    }

}