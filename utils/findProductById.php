<?php

function findProductById($products, $productId)
{
    foreach ($products as $product) {
        if ($product['id'] == $productId) {
            return [
                'id' => $product['id'],
                'userId' => $product['userId'],
                'title' => $product['title'],
                'description' => $product['description'],
                'interestedUsers' => $product['interestedUsers'],
                'img' => $product['img']
            ];
        }
    }
}
