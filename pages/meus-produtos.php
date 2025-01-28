<?php
require_once('../config.php');

use src\Entities\Product;
use utils\Verifier;

$authenticatedUser = Verifier::verifySession();
$myProducts = Product::findByUser($authenticatedUser);
$myProductsArray = $myProducts->getArrayCopy();
$myProductsCount = $myProducts->count();

$cardsPerPage = 4;
$pageCount = ceil($myProductsCount / $cardsPerPage);
$pageNumber = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($pageNumber * $cardsPerPage) - $cardsPerPage;
$myProductsArray = array_slice($myProductsArray, $offset, $cardsPerPage);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>


<body class="flex flex-col items-center">
<?php include_once('../components/header.php'); ?>
<div class="mb-4">
    <h1 class="text-xl font-bold mt-12 mb-4">Meus anúncios</h1>
    <main class="flex flex-col gap-4">
        <?php
        if (count($myProductsArray) > 0) {
            foreach ($myProductsArray as $product) {
                require('../components/myProductCard.php');
            }
        } else {
            echo "<span>Você não tem produtos cadastrados</span>";
        }
        ?>

    </main>

    <?php
    if ($pageCount > 1)
        require_once('../components/pagingNavigation.php') ?>


</div>


</body>

</html>