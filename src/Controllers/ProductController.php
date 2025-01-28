<?php

namespace src\Controllers;


use Cassandra\Collection;
use src\Actions\UploadFileAction;
use src\DTOs\UserDTO;
use src\Entities\Product;
use src\Entities\Photo;
use src\Entities\User;
use src\Services\ProductService;
use utils\Verifier;

class ProductController
{
    public static function loadProducts(UserDTO $user): array
    {
        $products = [];

        try {
            $products = Product::notMineWithPhotoAndUser($user);
        } catch (\Exception $e) {

        }
        return $products;
    }

    public static function createProduct(): bool|string
    {
        session_start();
        if (!($_SESSION['authenticatedUser'])) {
            return false;
        }

        try {
            //inputs from the form
            $title = filter_input(INPUT_POST, 'title');
            $description = filter_input(INPUT_POST, 'description');

            //user from the session
            $authenticatedUser = $_SESSION['authenticatedUser'];
            $owner = new UserDTO($authenticatedUser->getId(), $authenticatedUser->getName(), $authenticatedUser->getEmail(), $authenticatedUser->getNeighborhood());

            //create photo that will be associated to the product
            return ProductService::uploadPhotoAndCreateProduct($title, $description, $owner);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public static function setInterestedUser(Product $product): bool|UserDTO|null
    {
        if (!($_SESSION['authenticatedUser'])) {
            return false;
        }
        if (Verifier::verifySession() !== $product->getOwner()) {
            return false;
        }
        $userId = filter_input(INPUT_POST, 'userId');
        $user = User::findById($userId);

        if (!$product->setInterestedUser($user)) {
            return false;
        }
        return $user;
    }
}