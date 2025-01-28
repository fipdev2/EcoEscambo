<?php

namespace src\Services;

use \src\Actions\UploadFileAction;
use src\Entities\Photo;
use src\Entities\Product;
use src\DTOs\UserDTO;

class ProductService
{
    public static function uploadPhotoAndCreateProduct(string $title, string $description, UserDTO $owner): bool
    {
        $upload = new UploadFileAction($_FILES['image']);
        if (!$upload->execute()) {
            return false;
        }
        $photo = new Photo($upload->getPath(), $upload->getClientPath());
        $photo->create();
        $createdPhoto = Photo::findByPath($photo->getPath());
        $newProduct = new Product($title, $description, $owner, $createdPhoto);
        if (!Product::create($newProduct)) {
            unlink($photo->getPath());
            $createdPhoto->delete();
            return false;
        }
        return true;

    }
}