<?php
namespace Src\Controllers;
class UserController
{
    public function loginForm(){
        require_once __DIR__ . '/../views/login.php';
    }
}