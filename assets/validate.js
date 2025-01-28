document.getElementById('registrationForm').addEventListener('submit', function(event) {
    var senha = document.getElementById('senha').value;
    var confirmarSenha = document.getElementById('confirmar_senha').value;
    var senhaRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}$/;

    if (senha !== confirmarSenha) {
        event.preventDefault(); // Impede o envio do formulário
        alert('As senhas não coincidem. Por favor, verifique novamente.');
    } else if (!senhaRegex.test(senha)) {
        event.preventDefault(); // Impede o envio do formulário
        alert('A senha deve ter no mínimo 6 caracteres, contendo pelo menos um número, uma letra maiúscula e uma letra minúscula.');
    }
});
