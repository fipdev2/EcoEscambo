<?php
$productId = $product->getId();
?>

<div class="p-4 flex gap-4 justify-between border border-gray-200 rounded-md ">
    <div class="flex gap-4">
        <img src="<?= $product->getPhoto()->getClientPath() ?>" alt="imagem do produto"
             class="w-40 h-40 rounded-md">

        <div class="flex flex-col gap-4 ">
            <span class="font-bold text-black text-lg"><?= $product->getTitle() ?></span>
            <p class="max-w-xl"><?= $product->getDescription(); ?></p>
        </div>
    </div>

    <div class="flex flex-col justify-between w-40">
        <button class="bg-[#121821] hover:opacity-60  text-white rounded-md font-semibold p-2"><a
                    href="../utils/delete.php?idProduto=<?= $product->getId() ?>">Excluir</a></button>
        <button class="border border-[#12182] hover:opacity-60  rounded-md font-semibold p-2"><a href="">Editar</a>
        </button>
        <form action="" method="post" class="w-full">
            <input type="text" name="productId" value="<?= $product->getId() ?>" hidden>
            <button name="seeInterests" class="bg-[#FFAA47] hover:opacity-60 rounded-md font-semibold p-2 w-full"><a
                        href="<?= "../pages/ver-interesses.php?productId=$productId" ?>">Ver interesses</a></button>
        </form>
    </div>
</div>
