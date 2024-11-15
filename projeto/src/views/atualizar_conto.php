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
    <title>Contos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

</head>
<body>
<nav>
    <div class="nav-wrapper">
        <a href="/" class="brand-logo">Contos</a>
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
        <h1>Atualizar Conto</h1>
        <form id="atualizar-conto-form">
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
            <button type="submit" class="btn">Atualizar Conto</button>
        </form>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        let conto_id = null;
        let isLogged = false;
        let usuario_id = null;

        function fetchLogin() {
            fetch('http://localhost:8000/isLogged')
                .then(response => response.json())
                .then(data => {
                    if (data.status === "sucesso") {
                        isLogged = (data.message === "Logado");
                        usuario_id = data.user_id;
                        conto_id = data.conto_id;
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
                        fetchConto();
                    }
                })
                .catch(error => alert('Erro ao buscar login: ' + error));
        }
 fetchLogin();

        function fetchConto() {
            if (conto_id) {
                fetch(`http://localhost:8000/api/contos/${conto_id}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === "sucesso") {
                            const html_titulo = document.getElementById('titulo');
                            const html_texto = document.getElementById('texto');
                            const html_data_publicacao = document.getElementById('data_publicacao');
                            html_titulo.value = data.message.titulo;
                            html_texto.value = data.message.texto;
                            html_data_publicacao.value = data.message.data_publicacao;
                        } else {
                            alert(data.message);
                        }
                    })
                    .catch(error => alert('Erro ao buscar contos: ' + error));
            } else {
                alert('ID do conto não encontrado.');
            }
        }

        document.getElementById('atualizar-conto-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const titulo = document.getElementById('titulo').value;
            const texto = document.getElementById('texto').value;
            const data_publicacao = document.getElementById('data_publicacao').value;

            fetch(`http://localhost:8000/api/contos/${conto_id}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    id: conto_id,
                    usuario_id: usuario_id,
                    titulo: titulo,
                    texto: texto,
                    data_publicacao: data_publicacao
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === "sucesso") {
                    alert('Conto atualizado com sucesso!');
                    window.location.href = '/'; // Redireciona para a página principal
                } else {
                    alert(data.message);
                }
            })
            .catch(() => {
                alert('Erro ao atualizar conto.');
            });
        });
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>