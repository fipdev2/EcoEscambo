<div class="w-full flex justify-center font-semibold mt-8 text-white flex gap-0.5">
    <?php
    if ($pageNumber == 1) {
        $previousPage = $pageNumber;
    } else {
        $previousPage = $pageNumber - 1;
        echo "<a href='?page=$previousPage' class='rounded-l-lg hover:bg-[#1D2939] px-4 py-2 bg-[#121821]'>Anterior</a>";
    }


    for ($i = 1; $i <= $pageCount; $i++) {

        $activeClass = ($i === $pageNumber) ? 'bg-[#FFAA47] hover:bg-[#FF9447]' : '';
        if ($i == 1 && $pageNumber == 1) {

            echo "<a href='?page=$i' class='$activeClass hover:bg-[#1D2939] px-4 py-2 bg-[#121821] rounded-l-md'>$i</a>";
        } else if ($i == $pageCount && $pageNumber == $pageCount) {
            echo "<a href='?page=$i' class='$activeClass hover:bg-[#1D2939] px-4 py-2 bg-[#121821] rounded-r-md'>$i</a>";
        } else {
            echo "<a href='?page=$i' class='$activeClass hover:bg-[#1D2939] px-4 py-2 bg-[#121821] '>$i</a>";
        }
    }

    if ($pageNumber == $pageCount) {
        $nextPage = $pageNumber;
    } else {
        $nextPage = $pageNumber + 1;
        echo "<a href='?page=$nextPage' class=' rounded-r-lg hover:bg-[#1D2939] px-4 py-2 bg-[#121821]'>Próximo</a>";
    }
    ?>
</div>
