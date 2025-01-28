<a href="../pages/detalhes-do-produto.php" class="">

    <div class="bg-white border border-gray-400 p-8 flex gap-8 w-full max-w-4xl rounded-md hover:bg-gray-100">
        <img src="<?= $product->getPhoto()->getClientPath() ?>" class="w-96 h-60 rounded-md">

        <div class="flex flex-col justify-between w-full">
            <div>
                <h1 class="font-semibold text-xl"><?= $product->getTitle() ?></h1>
                <p class="mt-2"><?= $product->getDescription(); ?></p>
            </div>

            <div class="flex justify-between">
                <div class="flex items-center gap-1">
                    <img src="../assets/localizacao.png" alt="localização" class="w-5">
                    <p><?= $product->getOwner()->getNeighborhood() ?></p>
                </div>

                <a href="?idproduto=<?= $product->getId() ?>"
                   class="<?php /*echo $interestClass*/ ?>  bg-[#121821] hover:opacity-60 text-white py-2 px-8 rounded-md">Tenho
                    interesse</a>
            </div>

        </div>
    </div>

</a>