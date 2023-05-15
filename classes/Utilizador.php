<?php

namespace classes;

use classes\Database\Database;

class Utilizador
{
    private $cod;
    private $user;
    private $pass;
    private $tipo;
    private $foto;

    public function getCod(){
        return $this->cod;
    }
    public function setCod($cod){
        $this->cod = $cod;
    }

    public function getUser(){
        return $this->user;
    }
    public function setUser($user){
        $this->user = $user;
    }

    public function getPass(){
        return $this->pass;
    }
    public function setPass($pass){
        $this->pass = $pass;
    }

    public function getTipo(){
        return $this->tipo;
    }
    public function setTipo($tipo){
        $this->tipo = $tipo;
    }

    public function getFoto(){
        return $this->foto;
    }
    public function setfoto($foto){
        $this->foto = $foto;
    }

    public static function addUtilizador($user, $email=null, $pass, $tipo, $foto='no_photo.png') {

        $sql = "INSERT INTO utilizador (username, email, pass, tipo, foto) VALUES ('$user', '$email', '$pass', '$tipo', '$foto')";

        $bd = new Database();

        $bd->query($sql);

    }


    public static function lastId(){

        $sql = "SELECT id FROM utilizador ORDER BY id DESC";

        $bd = new Database();
        $result = $bd->select($sql);

        return $result[0]->id;
    }

    public static function atualizarUtilizador($id, $user, $pass, $tipo, $foto) {

        $sql = "UPDATE utilizador SET username = '$user', pass = '$pass', tipo = '$tipo', foto = '$foto' WHERE id = '$id' ";

        $bd = new Database();

        $bd->query($sql);

    }

    public static function tipoCliente() {
        $sql = "SELECT id FROM tipoutilizador WHERE tipo = 'Cliente' ";

        $bd = new Database();
        $result = $bd->select($sql);

        return $result[0]->id;

    }

    public static function validaLogin($username, $password) {
        $sql = "SELECT u.id, u.username, u.pass, u.foto, f.nomeFunc, t.tipo
                FROM utilizador u
                JOIN funcionario f ON f.user = u.id
                JOIN tipoutilizador t ON u.tipo = t.id
                WHERE u.username = '$username' AND u.pass = '$password' ";

        $bd = new Database();
        return $bd->select($sql);
    }

}