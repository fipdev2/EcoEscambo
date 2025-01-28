<?php
session_start();

require_once('../components/formHeader.php');

?>
<html lang="pt-br">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body class="font-sans h-full w-full m-0 p-0 bg-[#f4f4f4]">
<?php require_once('../components/formHeader.php'); ?>
<div class="max-w-xl mt-10 m-5 m-auto p-5 bg-[#fff] rounded-md shadow-lg">
    <h2 class="text-center text-lg font-semibold color-[#121821] mb-4">Acesse sua conta</h2>
    <form action="../utils/authenticate.php" method="POST">
        <label for="email">Email:</label>
        <input class="w-full p-2.5 mb-2.5 border-solid border border-[#ccc] rounded-md box-border"
               type="email"
               id="email" name="email"
               required>
        <label for="password">Senha:</label>
        <input class="w-full p-2.5 mb-2.5 border-solid border border-[#ccc] rounded-md box-border"
               type="password"
               id="password"
               name="password"
               required>
        <input class="w-full p-2.5 mb-2.5 bg-[#121821] text-white border-none rounded-full box-border hover:bg-[#212c3d]"
               type="submit"
               value="Continuar">
    </form>
    <div class="forgot-password">
        <a href="redefinir-senha.php">Esqueci minha senha</a>
    </div>
    <div class="text-center">
        <p>Não tem uma conta? <a class="text-none text-[#007bff]" href="cadastro.php">Cadastre-se</a></p>
    </div>
</div>
</body>
</html>
