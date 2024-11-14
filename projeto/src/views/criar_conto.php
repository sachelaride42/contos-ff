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
    <title>Criar Conto</title>
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
        <h1>Criar Novo Conto</h1>
        <form id="criar-conto-form">
            <div class="input-field">
                <input type="text" id="titulo" required>
                <label for="titulo">Título</label>
            </div>
            <div class="input-field">
                <textarea id="texto" name class="materialize-textarea" required></textarea>
                <label for="texto">Texto</label>
            </div>
            <div class="input-field">
                <input type="date" name= "data_publicacao" id="data_publicacao" required>
                <label for="data_publicacao">Data de Publicação</label>
            </div>
            <button type="submit" class="btn">Criar Conto</button>
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

            document.getElementById('criar-conto-form').addEventListener('submit', function(e) {
                e.preventDefault();

                const titulo = document.getElementById('titulo').value;
                const texto = document.getElementById('texto').value;
                const data_publicacao = document.getElementById('data_publicacao').value;
                fetch('http://localhost:8000/api/contos', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({usuario_id,data_publicacao, titulo, texto})
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === "sucesso") {
                        alert('Conto criado com sucesso!');
                        window.location.href = '/'; // Redireciona para a página principal
                    } else {
                        alert(data.message);
                    }
                })
                .catch(() => {
                    alert('Erro ao criar conto.');
                });
            });
        });
    </script>
</body>
</html>