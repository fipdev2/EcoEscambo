<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperação de Senha</title>
    
</head>
<body class="font-sans h-full w-full m-0 p-0 bg-[#f4f4f4]">
    <?php require_once("../components/formHeader.php") ?>
    <div class="max-w-xl mt-10 m-5 m-auto p-5 bg-[#fff] rounded-md shadow-lg">
        <h2 class="text-center text-lg font-semibold color-[#121821] mb-4">Recuperação de Senha</h2>
        <p class="mb-10">Informe seu e-mail para recuperar a senha:</p>
        <form action="#" method="post">
            <label for="email">E-mail:</label>
            <input class="w-full p-2.5 mb-10 border-solid border border-[#ccc] rounded-md box-border" type="email" id="email" name="email" required>

            <input class="w-full p-2.5 mb-2.5 bg-[#121821] text-white border-none rounded-full box-border hover:bg-[#212c3d]" type="submit" value="Recuperar Senha">
        </form>
    </div>
</body>
</html>
