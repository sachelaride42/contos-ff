<?php
if (session_status() === PHP_SESSION_NONE){
    session_start();
}
$_SESSION["isLogged"] = true;
$_SESSION["user"] = 2;
header("Location: /");
?>