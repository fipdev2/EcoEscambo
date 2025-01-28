<?php
require_once('../utils/findProductById.php');
require_once('../utils/findAllMyProducts.php');
require_once('../config.php');

use \src\Entities\Product;
use \src\Controllers\ProductController;

$productId = $_GET['productId'];
$myProduct = Product::findById($productId);
$interestedUsers = [];


global $myProduct;
if (isset($_POST['submit'])) {
    $chosenUser = ProductController::setInterestedUser($myProduct);
}


?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver interesses</title>
</head>

<body class="flex flex-col items-center">
<?php require_once("../components/header.php") ?>

<div class="flex flex-col">


    <h1 class="text-xl font-bold mb-4 mt-12">Ver interesses</h1>
    <main>

        <div class="border border-gray-200 rounded-xl py-4 px-16">
            <div class="font-bold flex flex-col items-center">
                <span>Você está trocando</span>
                <img src="../assets/changing.svg" alt="">
            </div>

            <div class="flex">
                <div class="flex flex-col flex-1">
                    <div class="flex flex-col mb-4">
                        <span class="font-bold"><?= $myProduct->getTitle(); ?></span>
                        <span class="text-gray-500 text-sm">Publicado em 10/04 às 22:42 - cód <?= $myProduct->getId(); ?></span>
                    </div>


                    <div class="flex gap-x-4">
                        <img src="<?= $myProduct->getPhoto()->getClientPath() ?>" ]
                             alt="foto do produto"
                             class="rounded-lg w-64 h-64">
                        <div class="flex flex-col justify-evenly">
                            <p>
                                <?= $myProduct->getDescription(); ?>
                            </p>

                            <div class="flex items-center gap-1">

                                <img src="../assets/star.svg" alt="">
                                <span><?= sizeof($interestedUsers) ?> <?= " " . sizeof($interestedUsers) > 1 ? 'pessoas' : 'pessoa' ?> se interessaram neste produto </span>
                            </div>
                            <form action="" method="post" class="flex flex-col h-1/2 justify-evenly">

                                <select name="userId" id="userId"
                                        class="py-1 px-1 border border-gray-200 rounded-md w-full block">
                                    <option selected
                                            disabled>
                                        <?= sizeof($interestedUsers) ? "Selecione um interessado"
                                            : "Ainda não há usuários interessados"
                                        ?>
                                    </option>

                                    <?php foreach ($interestedUsers as $user) : ?>
                                        <option value="<?= $user['id'] ?>"><?= $user['username'] ?></option>
                                    <?php endforeach ?>

                                </select>
                                <button type="submit" id="submit"
                                        class="bg-[#121821] text-white p-1 rounded-md hover:opacity-60 w-full">Escolher
                                    interessado
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="flex flex-1 justify-center items-center">
                    <span>Produto selecionado aparecerá aqui</span>
                </div>
            </div>
        </div>

        <div class="flex mt-32 items-center justify-center">
            <span>Selecione um interessado</span>
        </div>
    </main>

</div>
</body>

</html>