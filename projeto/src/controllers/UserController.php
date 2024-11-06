<?php
namespace Src\controllers;
use DaoController;
use Src\models\User;
class UserController
{
    public function loginForm(){
        require_once __DIR__ . '/../views/login.php';
    }
    public function login(){
        $data = json_decode(file_get_contents("php://input"), true);
        $email = isset($data['email']) ? $data['email'] : null;
        $senha = isset($data['senha']) ? $data['senha'] : null;

        $user = new User($email, $senha);

        if($user->validateLogin($email, $senha)){
            echo json_encode([
                'status' => 'success',
                'message' => 'Login realizado com sucesso.'
            ]);
        }else{
            echo json_encode([
                'status' => 'error',
                'message' => 'Email ou senha incorretos.'
            ]);
        }
    }

    public function registerForm() {
        require_once __DIR__ . '/../views/register.php';
    }

    public function register(){
        $data = json_decode(file_get_contents("php://input"), true);
        $nome = isset($data['nome']) ? $data['nome'] : null;
        $email = isset($data['email']) ? $data['email'] : null;
        $senha = isset($data['senha']) ? $data['senha'] : null;
        $confirmaSenha = isset($data['confirmaSenha']) ? $data['confirmaSenha'] : null;

        $user = new User($nome, $email, $senha);

        if($senha != $confirmaSenha){
            echo json_encode([
                'status' => 'error',
                'message' => 'Senhas não correspondem.'
            ]);
            return;
        }
        if($user->validateRegister($nome, $email, $senha)){
            $daoController = new DaoController();
            if($daoController->registerUser($user)[0]){
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Cadastro realizado com sucesso.'
                ]);
            }else{
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Erro ao registrar o usuário.'
                ]);
            }
        }else{
            echo json_encode([
                'status' => 'error',
                'message' => $user->validateRegister($nome, $email, $senha)[1]
            ]);
        }

    }
}