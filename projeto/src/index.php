<?php
$route = $_SERVER['REQUEST_URI'];
$parsedURL = parse_url($route);
$route = $parsedURL['path'];


switch ($route) {
    case '/user/create':
        $userController = new userController();
        $userController->abrirTelaCadastro();
        break;
    case '/user/store':
        $userController = new userController();
        $userController->cadastrarUsuario();
        break;
    case '/user/delete':
        $userController = new userController();
        $userController->deletarUsuario();
        break;

    default:
        echo 'Erro 404: Página não encontrada';
        break;
}