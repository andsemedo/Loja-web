<?php

namespace classes;

use classes\Database\Database;

class Funcionario
{
    private $nome;
    private $telefone;
    private $nif;
    private $morada;
    private $user;

    public function getNome(){
        return $this->nome;
    }
    public function setNome($nome){
        $this->nome = $nome;
    }

    public function getTelefone(){
        return $this->telefone;
    }
    public function setTelefone($telefone){
        $this->telefone = $telefone;
    }

    public function getNif(){
        return $this->nif;
    }
    public function setNif($nif){
        $this->nif = $nif;
    }

    public function getMorada(){
        return $this->morada;
    }
    public function setMorada($morada){
        $this->morada = $morada;
    }

    public function getUser(){
        return $this->user;
    }
    public function setUser($user){
        $this->user = $user;
    }

    public static function addFuncionario($nome, $telefone, $nif, $morada, $user) {

        

        $sql = "INSERT INTO funcionario (nomeFunc, telefone, nif, morada, user) VALUES ('$nome', '$telefone', '$nif', '$morada', '$user')";

        $bd = new Database();

        $bd->query($sql);
        
    }

    public static function atualizarUserFunc($id, $nome, $telefone, $morada, $user, $pass, $tipo, $foto) {

        $sql = "UPDATE funcionario SET nomeFunc = '$nome', telefone = '$telefone', morada = '$morada' WHERE user = '$id' ";

        $bd = new Database();
        $bd->query($sql);

        Utilizador::atualizarUtilizador($id, $user, $pass, $tipo, $foto);

    }

    public static function detalhesFuncionario($id) {

        $sql = "SELECT f.codFunc, f.user, f.nomeFunc, f.morada, f.telefone, f.nif, u.username, u.pass, u.foto, t.tipo FROM utilizador as u
        JOIN funcionario as f ON u.id = f.user
        JOIN tipoutilizador as t ON u.tipo = t.id WHERE f.user = '$id'";
        
        $bd = new Database();
        return $bd->select($sql);
    }

    public static function deleteFuncionario($id) {

        $sql = "DELETE FROM funcionario
                WHERE user = '$id' ";

        $bd = new Database();
        $bd->query($sql);

    }


}