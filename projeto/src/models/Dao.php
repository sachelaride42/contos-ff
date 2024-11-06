<?php
namespace Src\models;

use PDOException;

class Dao{
    private $pdo;
    public function __construct(){
        $this->pdo = new PDO("mysql:host=localhost;dbname=contos", "root", "admin");
    }

    public function registerUser($user){
        try {
            $query = "INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(":nome", $user->getNome());
            $stmt->bindValue(":email", $user->getEmail());
            $stmt->bindValue(":senha", $user->getSenha());
            return $stmt->execute();
        }catch(PDOException $e){
            return false;
        }
    }


}