<?php
namespace Src\models;

use PDOException;

class Dao
{
    private $conn;

    public function __construct()
    {
        $this->conn = new PDO("mysql:host=localhost;dbname=contos", "root", "admin");
    }

    public function registerUser($user)
    {
        try {
            $query = "INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(":nome", $user->getNome());
            $stmt->bindValue(":email", $user->getEmail());
            $stmt->bindValue(":senha", $user->getSenha());
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function loginUser($user)
    {
        try {
            $query = "SELECT * FROM usuarios WHERE email = :email AND senha = :senha";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(":email", $user->getEmail());
            $stmt->bindValue(":senha", $user->getSenha());
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function createConto($conto)
    {
        try {
            $query = "INSERT INTO contos (usuario_id, titulo, data_publicacao, texto) VALUES (:usuario_id, :titulo, :data_publicacao, :texto)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(":usuario_id", $conto->getUsuarioId());
            $stmt->bindValue(":titulo", $conto->getTitulo());
            $stmt->bindValue(":data_publicacao", $conto->getDataPublicacao());
            $stmt->bindValue(":texto", $conto->getTexto());
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function destroyConto($id)
    {
        try {
            $query = "DELETE FROM contos WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(":id", $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function updateConto($conto){
        try {
            $query = "UPDATE contos SET titulo = :titulo, data_publicacao = :data_publicacao, texto = :texto WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(":titulo", $conto->getTitulo());
            $stmt->bindValue(":data_publicacao", $conto->getDataPublicacao());
            $stmt->bindValue(":texto", $conto->getTexto());
            $stmt->bindValue(":id", $conto->getId());
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function indexContos()
    {
        try {
            $query = "SELECT * FROM contos";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return "Erro ao listar os contos";
        }
    }

    public function showConto($id)
    {
        try {
            $query = "SELECT * FROM contos WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $e) {
            return "Erro ao buscar conto";
        }
    }
}