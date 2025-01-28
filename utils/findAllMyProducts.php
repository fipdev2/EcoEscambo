<?php
function findProductsByUser($user_id)
{
    require('..\database\Database.php');
    $result = $conn->query("SELECT * FROM produtos WHERE idAnunciante = $user_id");

    return $result;
}
