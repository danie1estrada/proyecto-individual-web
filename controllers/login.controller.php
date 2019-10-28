<?php
require_once('../controllers/user.controller.php');
require_once('../config/config.php');

use Controllers\UserController;

$username = $_POST['username'];
$password = $_POST['password'];

$user_controller = new UserController();
$row = $user_controller->login($username, $password);

if (!$row) {
    header('Location: '.URL.'/views/login.php?error=Nombre de usuario o contraseña incorrectos.');
} else {
    session_start();
    $_SESSION['login'] = $row['id'];
    echo $_SESSION['login'];
    header('Location: '.URL.'/views/');
}