<?php

namespace classes;

use classes\Database\Database;

class Cliente
{
    private $id;
    private $nome;
    private $telefone;
    private $localidade;
    private $rua;
    private $casa;

    public function setId($id) {
        $this->id = $id;
    }
    public function getId() {
        return $this->id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }
    public function getNome() {
        return $this->nome;
    }

    public function setTelefone($telefone) {
        $this->telefone = $telefone;
    }
    public function getTelefone() {
        return $this->telefone;
    }

    public function setLocalidade($localidade) {
        $this->localidade = $localidade;
    }
    public function getLocalidade() {
        return $this->localidade;
    }

    public function setRua($rua) {
        $this->rua = $rua;
    }
    public function getRua() {
        return $this->rua;
    }

    public function setCasa($casa) {
        $this->casa = $casa;
    }
    public function getCasa() {
        return $this->casa;
    }

    public static function addCliente($nome, $telefone, $endereco, $user,$nif) {

        $sql = "INSERT INTO cliente (nome, telefone, endereco, user, Nif) VALUES ('$nome', '$telefone', '$endereco', '$user', '$nif') ";

        $bd = new Database();
        $bd->query($sql);
    }

    public static function detalhesCliente($id) {

        $sql = "SELECT c.codCliente, c.nome, u.email, c.telefone, u.username, u.pass, u.tipo, u.foto, c.endereco, c.user
                FROM cliente c
                JOIN utilizador u ON c.user = u.id WHERE c.user = '$id' ";

        $bd = new Database();

        return $bd->select($sql);
    }

    public static function deleteCliente($id) {

        $sql = "DELETE FROM cliente
                WHERE codCliente = '$id' ";

        $bd = new Database();
        $bd->query($sql);

    }

    public static function editarCliente($id, $nome, $telefone, $localidade, $username, $pass) {

        $sql = "UPDATE cliente c, endereco e, utilizador u
                SET c.nome = '$nome', c.telefone = '$telefone', e.localidade = '$localidade', u.username = '$username', u.pass = '$pass'
                WHERE c.codCliente = '$id' AND c.endereco = e.codEndereco AND c.user = u.id";

        $bd = new Database();
        $bd->query($sql);
        
    }

    public static function totalClientes() {
        $sql = "SELECT COUNT(codCliente) AS numClientes FROM cliente ";

        $bd = new Database();
        $result = $bd->select($sql);

        $qtd = 0;
        foreach ($result as $res) {
            $qtd = $res->numClientes;
        }

        return $qtd;

    }

    public static function validaLogin($username, $password) {
        $sql = "SELECT * FROM utilizador u
                JOIN cliente c ON c.user = u.id
                WHERE u.tipo = '3' AND (u.username = '$username' OR u.email = '$username') AND u.pass = '$password' ";

        $bd = new Database();
        $result = $bd->select($sql);

        return $result;

    }

    public static function criarConta($nome, $email, $telefone, $user, $pass, $foto = 'no_photo.png') {

        $bd = new Database();


        $sql2 = "INSERT INTO utilizador (username, email, pass, tipo, foto) VALUES ('$user', '$email', '$pass', '3', '$foto') ";

        $bd->query($sql2);

        $user_id = Utilizador::lastId();

        $sql3 = "INSERT INTO cliente (nome, telefone, user) VALUES ('$nome', '$telefone', '$user_id') ";

        $bd->query($sql3);

    }

}