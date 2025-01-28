<?php

namespace src\Controllers;

use src\Entities\User;

class UserController
{
    public static function signUp(): bool|string
    {
        try {
            $name = filter_input(INPUT_POST, 'name');
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $password = filter_input(INPUT_POST, 'password');
            $neighborhood = filter_input(INPUT_POST, 'neighborhood');
            $newUser = new User($name, $email, $password, $neighborhood);

            return $newUser->create();
        } catch (\PDOException $e) {
            return $e->getMessage();
        }
    }

    public static function login(): bool
    {
        try {
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $password = filter_input(INPUT_POST, 'password');
            return User::checkPassword($email, $password);
        } catch (\PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}