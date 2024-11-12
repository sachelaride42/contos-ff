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
        <a href="#" class="brand-logo">Contos</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="/cadastro">Cadastro</a></li>
            <li><a href="/login">Login</a></li>
            <li><a href="/criar-conto">Criar Conto</a></li>
            <li><a href="/meus-contos">Meus Contos</a></li>
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
        const logoutButton = document.getElementById('logout');
        const isLogged = <?php isset($_SESSION["isLogged"]);?>;

        // Esconde o botão de logout se não estiver logado
        if (!isLogged) {
            logoutButton.style.display = 'none';
        } else {
            logoutButton.addEventListener('click', function() {
                <?php unset($_SESSION["isLogged"]);?>
                window.location.reload();
            });
        }

        // Função para buscar contos
        function fetchContos() {
            fetch('http://localhost:8000/api/contos')
                .then(response => response.json())
                .then(data => {
                    if (data.status === "sucesso") {
                        const contosHtml = data.message.map(conto => `
                                <div class="card">
                                    <div class="card-content">
                                        <span class="card-title">${conto.titulo}</span>
                                        <p>${conto.texto}</p>
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
        fetchContos(); // Chama a função para buscar contos
    });
</script>
</body>
</html>