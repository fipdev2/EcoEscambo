<?php
    
        $idProduto = $_GET['idProduto'];
        require_once('..\database\Database.php');
        $conn->query("DELETE FROM produtos WHERE idProduto=$idProduto");
        header("Location: {$_SERVER['HTTP_REFERER']}");
?>