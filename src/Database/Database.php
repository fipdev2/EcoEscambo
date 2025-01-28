<?php

namespace src\Database;

use PDO;

abstract class Database
{

    public static function connect(): PDO
    {
        if ($_SERVER['SERVER_NAME'] == 'localhost') {

            $pdo = new PDO("mysql:host=127.0.0.1;port=3306;dbname=ecoescambo;charset=utf8mb4", 'root', '123');
        } else {
            $pdo = new PDO("mysql:host=sql305.infinityfree.com;port=3306;dbname=if0_36418938_eco_escambo;charset=utf8mb4", 'if0_36418938', 'whgEsfCAId');
        }

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }
}
