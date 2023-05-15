<?php

namespace classes;

use classes\Database\Database;

class Endereco {

    private $id;
    private $localidade;
    private $ilha;
    private $municipio;

    public function setId($id) {
        $this->id = $id;
    }
    public function getId() {
        return $this->id;
    }

    public function setLocalidade($localidade) {
        $this->localidade = $localidade;
    }
    public function getLocalidade() {
        return $this->localidade;
    }

    public function setIlha($ilha) {
        $this->ilha = $ilha;
    }
    public function getIlha() {
        return $this->ilha;
    }

    public function setMunicipio($municipio) {
        $this->municipio = $municipio;
    }
    public function getMunicipio() {
        return $this->municipio;
    }

    public static function addEndereco($localidade, $ilha, $municipio) {
        $sql = "INSERT INTO endereco (ilha, municipio, localidade) VALUES ('$ilha', '$municipio', '$localidade') ";

        $bd = new Database();
        $bd->query($sql);
    }

    public static function updateEndereco($localidade, $ilha, $municipio, $id_cliente) {
        $sql = "UPDATE endereco e, cliente c SET ilha = '$ilha', municipio = '$municipio', localidade = '$localidade' WHERE c.codCliente= '$id_cliente' AND e.codEndereco = c.endereco; ";

        $bd = new Database();
        $bd->query($sql);
    }

    public static function lastId(){

        $sql = "SELECT codEndereco FROM endereco ORDER BY codEndereco DESC";

        $bd = new Database();
        $result = $bd->select($sql);

        return $result[0]->codEndereco;
    }

}