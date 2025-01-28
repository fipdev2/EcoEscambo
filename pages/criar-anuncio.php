<?php
require_once("../config.php");
require_once("../components/header.php");

use src\Controllers\ProductController;

/*if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $servername = "#####";
    $username = "#####";
    $password = "#####";
    $dbname = "#####";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Erro de conexão: " . $conn->connect_error);
    }

    $nome = $_POST["nome"];
    $descricao = $_POST["descricao"];
    $imagem = $_FILES["imagem"]["name"];
    $imagem_temp = $_FILES["imagem"]["tmp_name"];


    move_uploaded_file($imagem_temp, "../Database/temp/" . $imagem);

    $sql = "INSERT INTO produtos (nome, descricao, imagem) VALUES ('$nome', '$descricao', '$imagem')";

    if ($conn->query($sql) === TRUE) {
        echo "<p>Produto cadastrado com sucesso!</p>";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}*/
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (ProductController::createProduct()) {
        echo "<script> window.alert('Produto cadastrado com sucesso') </script>";
    } else {
        echo "<script> window.alert('Erro ao cadastrar produto') </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Produto</title>
</head>

<body class="font-sans h-full w-full m-0 p-0 bg-[#f4f4f4]">

<div class="max-w-xl mt-10 m-5 m-auto p-5 bg-[#fff] rounded-md shadow-lg">

    <h2 class="text-center text-lg font-semibold color-[#121821] mb-4">Cadastro de Produto</h2>
    <form action="#" method="POST" enctype="multipart/form-data">
        <label for="name">Nome do Produto:</label>
        <input class="w-full p-2.5 mb-2.5 border-solid border border-[#ccc] rounded-md box-border"
               type="text"
               id="title"
               name="title"
               required>

        <label for="descricao">Descrição:</label>
        <textarea class="w-full p-2.5 mb-2.5 border-solid border border-[#ccc] rounded-md box-border"
                  id="description"
                  name="description"
                  rows="4"
                  required></textarea>

        <label for="image">Imagem do Produto:</label>
        <input class="w-full p-2.5 mb-2.5 border-solid border-[#ccc] rounded-md box-border"
               type="file"
               id="image"
               name="image"
               accept="image/*"
               required>

        <input class="w-full p-2.5 mb-2.5 bg-[#121821] text-white border-none rounded-full box-border hover:bg-[#212c3d]"
               type="submit"
               value="Cadastrar Produto">
    </form>
</div>
</body>
</html>