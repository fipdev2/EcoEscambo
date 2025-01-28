<?php
require_once("../components/formHeader.php");
require_once("../config.php");

use src\Controllers\UserController;

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    if (UserController::signUp() === true) {
        echo "<script> window.alert('Usuário criado com sucesso') </script>";
        header('Location: login.php');
    } else if (str_contains(UserController::signUp(), 'Duplicate entry')) {
        echo "<script> window.alert('Este email já foi cadastrado')</script>";
    } else {
        echo "<script> window.alert('Erro ao criar usuário')</script>";
    }
}
?>

<html lang="pt-br">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastre-se</title>
</head>
<body class="font-sans h-full w-full m-0 p-0 bg-[#f4f4f4]">
<div class="max-w-xl mt-10 m-auto p-5 bg-[#fff] rounded-md shadow-lg">
    <h2 class="text-center text-lg font-semibold color-[#121821] mb-4">Cadastre-se</h2>
    <form action="#" method="POST">
        <label for="name">Nome:</label>
        <input class="w-full p-2.5 mb-2.5 border-solid border border-[#ccc] rounded-md box-border"
               type="text"
               id="name"
               name="name"
               required>
        <label for="email">Email:</label>
        <input class="w-full p-2.5 mb-2.5 border-solid border border-[#ccc] rounded-md box-border"
               type="email"
               id="email"
               name="email"
               required>
        <label for="password">Senha:</label>
        <input class="w-full p-2.5 mb-2.5 border-solid border border-[#ccc] rounded-md box-border"
               type="password"
               id="password"
               name="password"
               required>
        <label for="neighborhood">Bairro:</label>
        <input class="w-full p-2.5 mb-2.5 border-solid border border-[#ccc] rounded-md box-border"
               type="text"
               id="neighborhood"
               name="neighborhood"
               required>
        <input class="w-full p-2.5 mb-2.5 bg-[#121821] text-white border-none rounded-full box-border hover:bg-[#212c3d]"
               type="submit"
               value="Cadastrar">
    </form>
    <div class="login">
        <p>Já tem uma conta? <a class="text-none text-[#007999]" href="login.php">Acesse sua conta</a></p>
    </div>
</div>
</body>
</html>
