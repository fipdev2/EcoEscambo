<?php
require_once("../config.php");
require_once("../components/header.php");

//require_once ("../utils/Verifier.php");

use src\Controllers\ProductController;
use src\DTOs\UserDTO;
use src\Entities\Product;
use utils\Verifier;

$authenticatedUser = Verifier::verifySession();
$pageNumber = isset($_GET['page']) ? intval($_GET['page']) : 1;
$cardsPerPage = 4;
$products = ProductController::loadProducts($authenticatedUser);
$productsCount = sizeof($products);
$offset = ($pageNumber * $cardsPerPage) - $cardsPerPage;
$limit = $cardsPerPage;
$pageCount = ceil($productsCount / $cardsPerPage);
$productsArray = array_slice($products, $offset, $limit);
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <script src="https://cdn.tailwindcss.com"></script>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Eco Escambo</title>
        <link rel="icon" href="../assets/favicon.ico" type="image/png">
    </head>

    <body class="h-full w-full bg-gray-100">

    <div class="w-full flex flex-col items-center ">
        <h2 class="text-xl font-bold mt-12 mb-4">
            <?= "Olá, " . $authenticatedUser->getName() ?>
        </h2>
        <div class="flex flex-col gap-4">
            <h1 class="text-xl font-bold mb-4">Catálogo de anúncios:</h1>


            <?php

            foreach ($productsArray as $product) {
                require("../components/card.php");
            }
            ?>
        </div>

        <?php
        if ($pageCount > 1)
            require_once("../components/pagingNavigation.php") ?>

    </div>


    </body>
    </html>

<?php


