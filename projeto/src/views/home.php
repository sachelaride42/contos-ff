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
    <h1>Todos os Contos</h1>
    <div id="contos"></div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let isLogged = false;
        function fetchLogin() {
            fetch('http://localhost:8000/isLogged')
                .then(response => response.json())
                .then(data => {
                    if (data.status === "sucesso") {
                        isLogged =  (data.message === "Logado")
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
                    fetchContos();
                })
                .catch(error => alert('Erro ao buscar login: ' + error));
        }
        fetchLogin();

        // Função para buscar contos
        function fetchContos() {
            fetch('http://localhost:8000/api/contos')
                .then(response => response.json())
                .then(data => {
                    if (data.status === "sucesso") {
                        const contosHtml = data.message.map(conto => `
                                <div class="row">
                                    <div class="col s12 m12 l12">
                                      <div class="card">
                                        <div class="card-content">
                                          <span class="card-title">${conto.titulo}</span>
                                          <p>${conto.texto}</p>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                            `).join('');
                        document.getElementById('contos').innerHTML = contosHtml;
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => alert('Erro ao buscar contos: ' + error));
        }
        // Chama a função para buscar contos
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>