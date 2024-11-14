<?php
if (session_status() === PHP_SESSION_NONE){
    session_start();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head>
<body>
    <nav>
        <div class="nav-wrapper">
            <a href="#" class="brand-logo">Contos</a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a id="criar-conto" href="/criar-conto">Criar Conto</a></li>
                <li><a id="meus-contos" href="/meus-contos">Meus Contos</a></li>
                <li><a id="login" href="/login">Login</a></li>
                <li><a id="cadastro" href="/cadastro">Cadastro</a></li>
                <li><a href="#" id="logout">Logout</a></li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <h1>Login</h1>
        <form id="login-form">
            <div class="input-field">
                <input type="text" id="email" required>
                <label for="email">Email</label>
            </div>
            <div class="input-field">
                <input type="password" id="senha" required>
                <label for="senha">Senha</label>
            </div>
            <button type="submit" class="btn">Login</button>
        </form>
    </div>

    <script>
document.addEventListener('DOMContentLoaded', function() {
    let usuario_id = null;
    let isLogged = false;
    function fetchLogin() {
        fetch('http://localhost:8000/isLogged')
        .then(response => response.json())
            .then(data => {
            if (data.status === "sucesso") {
                isLogged =  (data.message === "Logado");
                usuario_id = data.user_id;
            }
            const criarContoButton = document.getElementById("criar-conto");
            const logoutButton = document.getElementById('logout');
            const loginButton = document.getElementById('login');
            const cadastroButton = document.getElementById('cadastro');
            const meusContosButton = document.getElementById('meus-contos');

            if (!isLogged) {
                logoutButton.style.display = 'none';
                meusContosButton.style.display = 'none';
                criarContoButton.style.display = 'none';
            } else {
                cadastroButton.style.display = 'none';
                loginButton.style.display = 'none';
                logoutButton.addEventListener('click', function() {
                    window.location.href = '/logout';
                });
            }
        })
            .catch(error => alert('Erro ao buscar login: ' + error));
    }
    fetchLogin();

    document.getElementById('login-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const email = document.getElementById('email').value;
        const senha = document.getElementById('senha').value;
        fetch('http://localhost:8000/api/usuarios', {
            method: 'POST',
            headers: {
            'Content-Type': 'application/json'
            },
            body: JSON.stringify({email, senha})
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === "sucesso") {
                alert('Usuário logado com sucesso');
                window.location.href = '/'; // Redireciona para a página principal
            } else {
                alert(data.message);
            }
        })
        .catch(() => {
            alert('Erro ao logar.');
        });
    });
});
</script>
</body>
</html>