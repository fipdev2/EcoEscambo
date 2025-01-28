<?php

namespace src\Traits;

use PDO;
use PDOException;
use src\Database\Database;
use src\DTOs\UserDTO;
use src\Entities\Product;
use \ArrayObject;

trait UserTrait
{
    public static function rowMapper($id, string $name, string $email, string $neighborhood): UserDTO
    {
        return new UserDTO($id, $name, $email, $neighborhood);
    }

    public static function findAll(): array
    {
        $pdo = Database::connect();
        $statement = $pdo->prepare("SELECT id, name, email, neighborhood FROM `users` ORDER BY `id` DESC");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_FUNC, "src\Traits\UserTrait::rowMapper");
    }

    public static function findById($id): ?UserDTO
    {
        $pdo = Database::connect();
        $statement = $pdo->prepare("SELECT * FROM `users` WHERE `id` = :id");
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetch();
        return new UserDTO($result['id'], $result['name'], $result['email'], $result['neighborhood']);
    }

    public function create(): bool
    {

        $name = $this->name;
        $email = $this->email;
        $password = self::encryptPassword($this->password, $this->salt);
        $salt = $this->salt;
        $neighborhood = $this->neighborhood;
        $pdo = Database::connect();
        $statement = $pdo->prepare("INSERT INTO  users (name, email, password, salt, neighborhood) VALUES (:name, :email, :password, :salt, :neighborhood)");
        $statement->bindParam(":name", $name, PDO::PARAM_STR);
        $statement->bindParam(":email", $email);
        $statement->bindParam(":password", $password, PDO::PARAM_STR);
        $statement->bindParam(":salt", $salt, PDO::PARAM_STR);
        $statement->bindParam(":neighborhood", $neighborhood, PDO::PARAM_STR);
        return $statement->execute();


    }

    public function update(): bool
    {
        try {
            $pdo = Database::connect();
            $id = $this->id;
            $name = $this->name;
            $email = $this->email;
            $password = self::encryptPassword($this->password, $this->salt);
            $table = $this->table;
            $statement = $pdo->prepare("UPDATE :table SET name=:name, email=:email, password=:password WHERE id=:id");

            $statement->bindParam(":table", $table, PDO::PARAM_STR);
            $statement->bindParam(":name", $name, PDO::PARAM_STR);
            $statement->bindParam(":email", $email, PDO::PARAM_STR);
            $statement->bindParam(":password", $password, PDO::PARAM_STR);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);

            return $statement->execute();

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    static function checkPassword(string $email, string $password): bool
    {
        $pdo = Database::connect();
        $statement = $pdo->prepare("SELECT * FROM `users` WHERE `email` = :email");
        $statement->bindParam(":email", $email, PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetch();
        $userPassword = $result['password'];

        return password_verify($password, $userPassword);
    }

    public static function findByEmail(string $email): ?UserDTO
    {
        $pdo = Database::connect();
        $statement = $pdo->prepare("SELECT * FROM `users` WHERE `email` = :email");
        $statement->bindParam(":email", $email, PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetch();
        return new UserDTO($result['id'], $result['name'], $result['email'], $result['neighborhood']);
    }

    static function encryptPassword(string $password, string $salt): string
    {
        return password_hash($password, PASSWORD_BCRYPT, ['salt' => $salt]);
    }

    function getFavouriteProducts(): ArrayObject
    {
        $pdo = Database::connect();
        $statement = $pdo->prepare("
        SELECT products.id,
               products.title,
               products.description,
               products.owner_id, 
               users.name,
               users.email,
               users.neighborhood,
               photos.id as photo_id,
               photos.path,
               photos.client_path 
        FROM products
            INNER JOIN photos ON products.photo_id = photos.id 
            INNER JOIN users ON products.owner_id = users.id 
            INNER JOIN favourites ON products.id = favourites.product_id
        WHERE favourites.user_id = :id
");
        $statement->bindParam(":id", $this->id, PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetchAll();

        $products = new ArrayObject();

        foreach ($result as $row) {
            $owner = new UserDTO($row['owner_id'], $row['name'], $row['email'], $row['neighborhood']);
            $photo = new Photo($row['path'], $row['client_path'], $row['photo_id']);
            $product = new Product($row['title'], $row['description'], $owner, $photo, $row['id']);
            $products->append($product);
        }
        return $products;
    }

    function setFavouriteProduct(Product $product): bool
    {
        $productId = $product->getId();
        $pdo = Database::connect();
        $statement = $pdo->prepare("
            INSERT INTO favourites (user_id, product_id) 
            VALUES (:user_id, :product_id)
");
        $statement->bindParam(":user_id", $this->id, PDO::PARAM_INT);
        $statement->bindParam(":product_id", $productId, PDO::PARAM_INT);
        return $statement->execute();
    }

    function removeFavouriteProduct(Product $product): bool
    {
        $productId = $product->getId();
        $pdo = Database::connect();
        $statement = $pdo->prepare("
            DELETE FROM favourites 
            WHERE user_id = :user_id 
            AND product_id = :product_id
        ");
        $statement->bindParam(":user_id", $this->id, PDO::PARAM_INT);
        $statement->bindParam(":product_id", $productId, PDO::PARAM_INT);
        return $statement->execute();
    }

}