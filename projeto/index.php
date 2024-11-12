<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/Router.php';

session_start();

$_SESSION["isLogged"] = true;

$router = new Router();
$router->route();