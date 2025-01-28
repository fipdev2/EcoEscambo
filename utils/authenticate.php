<?php

use src\Entities\User;
use src\Controllers\UserController;

require_once("../config.php");

if (UserController::login()) {
    try {
        session_start();
        $authenticatedUser = User::findByEmail(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
        $_SESSION["authenticatedUser"] = $authenticatedUser;
        header("Location: ../pages/home.php");
    } catch (\PDOException $e) {
        session_unset();
    }
} else {
    session_unset();
    echo "<script> window.alert('Credenciais erradas') </script>";
}