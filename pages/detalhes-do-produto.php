<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do produto</title>
</head>


<body class="flex flex-col items-center">
    <?php
    require_once('../components/header.php');
    ?>
    <div>
        <h1 class="mt-12 mb-4 font-bold font-xl">Detalhes do produto</h1>
        <main class="flex flex-col items-center">
            <div class="border border-gray-200 rounded-xl py-4 px-16">

                <div class="flex">
                    <div class="flex flex-col flex-1">
                        <div class="flex flex-col mb-4">
                            <span class="font-bold">Ar Condicionado Consul 7500</span>
                            <span class="text-gray-500 text-sm">Publicado em 10/04 às 22:42 - cód <?= $myProduct['id']; ?></span>
                        </div>


                        <div class="flex gap-x-4">
                            <img src="../storage/24_06_2024_00_27_19.jpeg" alt="foto do produto" class="rounded-lg w-32 h-32">
                            <div class="flex flex-col justify-evenly">
                                <p>
                                    Gelando firme ótimo estado sem vazamento sem problema de ventilação ou problemas no motor 127 7500 BTUs
                                </p>

                                <div class="flex items-center gap-1">
                                    <img src="../assets/star.svg" alt="">
                                    <span>3 pessoas se interessaram neste produto </span>
                                </div>

                                <button type="submit" id="submit" class="bg-[#121821] text-white p-1 rounded-md hover:opacity-60 w-full">Manifestar interesse</button>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </main>
    </div>
</body>

</html>