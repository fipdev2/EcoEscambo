<?php

namespace src\Traits;

use src\Database\Database;
use src\Entities\Photo;

trait PhotoTrait
{
    public function create(): bool
    {
        $pdo = Database::connect();
        $path = $this->getPath();
        $clientPath = $this->getClientPath();

        $statement = $pdo->prepare("INSERT INTO photos (path, client_path) VALUES (:path, :client_path)");
        $statement->bindParam(":path", $path);
        $statement->bindParam(":client_path", $clientPath);

        return $statement->execute();
    }

    public static function findByPath(string $path): ?Photo
    {
        $pdo = Database::connect();

        $statement = $pdo->prepare("SELECT * FROM photos WHERE path = :path");

        $statement->bindParam(":path", $path);
        $statement->execute();

        $result = $statement->fetch();
        return new Photo($result['path'], $result['client_path'], intval($result['id']));
    }

    public function delete(): bool
    {
        $pdo = Database::connect();
        $id = $this->getId();
        $statement = $pdo->prepare("DELETE FROM photos WHERE id = :id");
        $statement->bindParam(":id", $id);

        return $statement->execute();
    }
}