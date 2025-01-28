<?php

namespace utils;

use src\DTOs\UserDTO;

class Verifier
{
    public static function verifySession(): UserDTO
    {
        session_start();
        if (!isset($_SESSION['authenticatedUser'])) {
            session_unset();
            return header('Location: login.php');
        } else {
            return new UserDTO(
                $_SESSION["authenticatedUser"]->getId(),
                $_SESSION["authenticatedUser"]->getName(),
                $_SESSION["authenticatedUser"]->getEmail(),
                $_SESSION["authenticatedUser"]->getNeighborhood()
            );

        }
    }
}


