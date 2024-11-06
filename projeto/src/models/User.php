<?php
namespace Src\models;
class User {
    private $usuario_id;
    private $nome;
    private $email;
    private $senha;

    public function __construct($nome = null, $email = null, $senha = null) {
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;
    }

    public function getUsuario_id() {
        return $this->usuario_id;
    }
    public function getNome() {
        return $this->nome;
    }
    public function getEmail() {
        return $this->email;
    }
    public function getSenha() {
        return $this->senha;
    }
    public function setUsuario_id($usuario_id) {
        $this->usuario_id = $usuario_id;
    }
    public function setNome($nome) {
        $this->nome = $nome;
    }
    public function setEmail($email) {
        $this->email = $email;
    }
    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function validateRegister($nome, $email, $senha) {
        if(empty($nome) || empty($email) || empty($senha)) {
            return [false, "Dados incompletos"];
        }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return [false, "Email em formato inválido."];
        }else if(strlen($senha) < 6) {
            return [false, "Senha muito curta, deve ser maior que 6 caracteres."];
        }else if(strlen($senha) > 15) {
            return [false, "Senha muito longa, deve ser menor que 15 caracteres."];
        }else{
            return [true];
        }



    }

}