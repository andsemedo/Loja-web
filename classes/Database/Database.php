<?php

namespace classes\Database;
use PDO;
use PDOException;

class Database
{
    private $conn;
    

    private function connect(){
        $this->conn = new PDO(
            'mysql:host=localhost;dbname=loja_projeto', 
            'lojaProjeto', 
            'admin123@',
            array(PDO::ATTR_PERSISTENT => true)
        );

        //debug
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }

    private function disconnect() {
        $this->conn = null;
    }

    public function select($sql) {  
        $this->connect();

        $resultados = null;

        try {

            //comunicacao com a BD        
            $executar = $this->conn->prepare($sql);
            $executar->execute();
            $resultados = $executar->fetchAll(PDO::FETCH_CLASS);
            
            
        } catch (PDOException $e) {
            
            return false;
        }

        $this->disconnect();

        return $resultados;
    }

    public function query($sql) {
        $this->connect();

        try {

            //comunicacao com a BD        
            $executar = $this->conn->prepare($sql);
            $executar->execute();
            
        } catch (PDOException $e) {
            
            return false;
        }

        $this->disconnect();
    }


}