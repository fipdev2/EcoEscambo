<?php

namespace src\Traits;

use PDO;
use \ArrayObject;
use src\Database\Database;
use src\DTOs\UserDTO;
use src\Entities\Photo;
use src\Entities\Product;
use src\Entities\User;

trait ProductTrait
{
    private static function rowMapper(string $id, string $title, string $description, string $ownerId, string $name, string $email, string $neighborhood, string $photoId, string $path, string $clientPath): Product
    {
        $owner = new UserDTO(intval($ownerId), $name, $email, $neighborhood);
        $photo = new Photo($path, $clientPath, intval($photoId));
        return new Product($title, $description, $owner, $photo, intval($id));
    }

    public static function create(Product $product): bool
    {
        $pdo = Database::connect();
        $title = $product->getTitle();
        $description = $product->getDescription();
        $ownerId = $product->getOwner()->getId();
        $photoId = $product->getPhoto()->getId();

        $statement = $pdo->prepare("
            INSERT INTO products 
                ( title, description, owner_id, photo_id) 
            VALUES 
                ( :title, :description, :owner_id, :photo_id)
    ");
        $statement->bindParam(":title", $title);
        $statement->bindParam(":description", $description);
        $statement->bindParam(":owner_id", $ownerId);
        $statement->bindParam(":photo_id", $photoId);
        return $statement->execute();
    }

    public static function findByUser(UserDTO $user): ?ArrayObject
    {

        $userId = $user->getId();
        $pdo = Database::connect();
        $statement = $pdo->prepare("
            SELECT 
            products.id,
            products.title,
            products.description,
            users.id,
            users.name,
            users.email,
            users.neighborhood,
            photos.id,
            photos.path,
            photos.client_path
             FROM products
             INNER JOIN photos ON products.photo_id = photos.id
             INNER JOIN users ON products.owner_id = users.id
             WHERE owner_id = :owner_id
             ");
        $statement->bindParam(":owner_id", $userId);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_FUNC, "src\\Entities\\Product::rowMapper");

        return new ArrayObject($result);

    }

    public static function findById(int $id): ?Product
    {
        $pdo = Database::connect();
        $statement = $pdo->prepare(" SELECT 
            products.id,
            products.title,
            products.description,
            users.id as owner_id,
            users.name,
            users.email,
            users.neighborhood,
            photos.id as photo_id,
            photos.path, 
            photos.client_path
             FROM products
             INNER JOIN photos ON products.photo_id = photos.id
             INNER JOIN users ON products.owner_id = users.id
             WHERE products.id = :id
             ");
        $statement->bindParam(":id", $id);
        $statement->execute();

        $result = $statement->fetch();
        $owner = new UserDTO($result['owner_id'], $result['name'], $result['email'], $result['neighborhood']);
        $photo = new Photo($result['path'], $result['client_path'], $result['photo_id']);
        return new Product($result['title'], $result['description'], $owner, $photo, $result['id']);
    }

    public function update(Product $product): bool
    {
        $pdo = Database::connect();
        $id = $product->getId();
        $title = $product->getTitle();
        $description = $product->getDescription();

        $statement = $pdo->prepare("UPDATE product SET title = :title, description = :description WHERE id = :id");
        $statement->bindParam(":id", $id);
        $statement->bindParam(":title", $title);
        $statement->bindParam(":description", $description);
        return $statement->execute();

    }

    public static function delete(Product $product, User $user): bool
    {
        if ($product->getOwner() === $user) {
            $productId = $product->getId();
            $pdo = Database::connect();
            $statement = $pdo->prepare("DELETE FROM product WHERE id = :id");
            $statement->bindParam(":id", $productId);
            return $statement->execute();
        } else {
            return false;
        }
    }

    public static function notMineWithPhotoAndUser(UserDTO $user): array
    {
        $userId = $user->getId();
        $pdo = Database::connect();
        $statement = $pdo->prepare("
            SELECT 
            products.id,
            products.title,
            products.description,
            users.id,
            users.name,
            users.email,
            users.neighborhood,
            photos.id,
            photos.path,
            photos.client_path
             FROM products
             INNER JOIN photos ON products.photo_id = photos.id
             INNER JOIN users ON products.owner_id = users.id
             WHERE owner_id != :owner_id
             ;
");
        $statement->bindParam(":owner_id", $userId);

        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_FUNC, "src\\Entities\\Product::rowMapper");
    }

    public function getInterestedUsers(): ArrayObject
    {
        $id = $this->getId();
        $pdo = Database::connect();
        $statement = $pdo->prepare("
            SELECT users.id, users.name, users.email, users.neighborhood
            FROM users
            INNER JOIN favourites ON users.id = favourites.user_id
            WHERE favourites.product_id = :product_id
        ");
        $statement->bindParam(":product_id", $id);
        $statement->execute();
        $result = $statement->fetchAll();

        $interestedUsers = new ArrayObject();
        foreach ($result as $row) {
            $interestedUsers->append(new UserDTO($row['id'], $row['name'], $row['email'], $row['neighborhood']));
        }
        return $interestedUsers;
    }

    public function setInterestedUser(UserDTO $user): bool
    {
        $interestedId = $user->getId();
        $pdo = Database::connect();
        $statement = $pdo->prepare("
            INSERT INTO trades (user_id, product_id) 
            VALUES (:user_id, :product_id)
        ");
        $statement->bindParam(":user_id", $interestedId);
        $statement->bindParam(":product_id", $this->id);
        return $statement->execute();
    }

}