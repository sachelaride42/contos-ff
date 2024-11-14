<?php
namespace Src\controllers;
use Src\controllers\DaoController;
use Src\models\User;
class UserController
{
    public function loginForm(){
        require_once __DIR__ . '/../views/login.php';
    }

    public function login(){
        header('Content-Type: application/json');

        if (session_status() === PHP_SESSION_NONE){
            session_start();
        }

        $data = json_decode(file_get_contents("php://input"), true);
        $email = isset($data['email']) ? $data['email'] : null;
        $senha = isset($data['senha']) ? $data['senha'] : null;

        $user = new User(null,$email, $senha);

        if($user->validateLogin($email, $senha)){
            $daoController = new DaoController();
            $loginUser = $daoController->loginUser($user);
            if($loginUser){
                $_SESSION["isLogged"] = true;
                $_SESSION["user"] = $loginUser["id"];
                echo json_encode([
                    'status' => 'sucesso',
                    'message' => 'Login realizado com sucesso.',
                ]);
            }else{
                echo json_encode([
                    'status' => 'erro',
                    'message' => 'Erro ao fazer login.'
                ]);
            }
        }else{
            echo json_encode([
                'status' => 'sucesso',
                'message' => $user->validateLogin($email, $senha)[1]
            ]);
        }
    }

    public function logout(){
        if (session_status() === PHP_SESSION_NONE){
            session_start();
        }
        if(isset($_SESSION["isLogged"])){
            unset($_SESSION["isLogged"]);
            unset($_SESSION["user"]);
        }
        header('Location: /');
    }

    public function isLogged(){
        header('Content-Type: application/json');
        if (session_status() === PHP_SESSION_NONE){
            session_start();
        }
        if(isset($_SESSION["isLogged"])){
            echo json_encode([
                'status' => 'sucesso',
                'message' => 'Logado',
                'user_id' => $_SESSION["user"]
            ]);
        }else{
            echo json_encode([
                'status' => 'erro',
                'message' => 'Não está logado'
            ]);
        }

    }

    public function registerForm() {
        require_once __DIR__ . '/../views/register.php';
    }

    public function register(){
        header('Content-Type: application/json');
        /*echo json_encode([
            'status' => 'error',
            'message' => 'Senhas não correspondem.'
        ]);*/
        $data = json_decode(file_get_contents("php://input"), true);
        $nome = isset($data['nome']) ? $data['nome'] : null;
        $email = isset($data['email']) ? $data['email'] : null;
        $senha = isset($data['senha']) ? $data['senha'] : null;
        $confirmaSenha = isset($data['confirmaSenha']) ? $data['confirmaSenha'] : null;

        $user = new User($nome, $email, $senha);

        if($senha != $confirmaSenha){
            echo json_encode([
                'status' => 'erro',
                'message' => 'Senhas não correspondem.'
            ]);
            return;
        }
        if($user->validateRegister($nome, $email, $senha)[0]){
            $daoController = new DaoController();
            if($daoController->registerUser($user)){
                echo json_encode([
                    'status' => 'sucesso',
                    'message' => 'Cadastro realizado com sucesso.'
                ]);
            }else{
                echo json_encode([
                    'status' => 'erro',
                    'message' => 'Erro ao registrar o usuário.'
                ]);
            }
        }else{
            echo json_encode([
                'status' => 'erro',
                'message' => $user->validateRegister($nome, $email, $senha)[1]
            ]);
        }

    }

    public function show($id){
        header('Content-Type: application/json');
        $daoController = new DaoController();
        $user = $daoController->showUser($id);
        if($user){
            echo json_encode([
                'status' => 'sucesso',
                'message' => $user["nome"]
            ]);
        }else{
            echo json_encode([
                'status' => 'erro',
                'message' => 'Usuario não encontrado.'
            ]);
        }
    }
}