# Contos-ff
## Tabela de conteúdos
- [Descrição](#descrição)
- [Pré-requisitos](#pré-requisitos)
- [Instalação](#instalação)
- [Uso](#uso)
- [Contribuir](#contribuir)
- [Contato](#contato)

## Descrição

Esse projeto é um website que tem como objetivo a criação e o compartilhamento de contos de ficção fantástica e ficção científica, permite que o cadastro e login de usuários, a visualização de contos feitos por outros usuários, e a criação, atualização ou deleção dos contos feitos por um usuário. Ele foi projetado para pessoas de todas as idades que gostem de ler e / ou  escrever contos de ficção. 

**Tecnologias:** front-end (HTML com Materialize); back-end: PHP

**Dependências:** composer, phpunit, MySQL

**Diagrama ER:** https://drive.google.com/file/d/1euFVSPDhHzlfEtlKPEJ-hGYBVf4egvR4/view?usp=drive_link

## Pré-requisitos

Before you begin, ensure you have met the following requirements:

- You have installed PHP 7.4 or higher.
- You have Composer installed on your machine. If not, follow the [Composer installation guide](https://getcomposer.org/doc/00-intro.md#installation).
- Tenha um banco de dados de sua preferência instalado no seu computador.
- A basic understanding of PHP and web development.

Antes de começar, garanta que você tenha cumprido os seguintes requerimentos:
- Tenha instalado a versão PHP 7.4 ou superior.
- Tenha o Composer instalado em sua máquina. Se não, siga [Guia de instalação do Composer](https://getcomposer.org/doc/00-intro.md#installation-windows)
- Tenha um conhecimento básico de PHP e desenvolvimento Web.

## Instalação

Para instalar esse projeto, siga os seguintes passos:

1. Clone o repositório: <br>
   No cmd:<br>
   *git clone https://github.com/sachelaride42/contos-ff.git<br>
   cd contos-ff<br>
   cd projeto*<br>

2. Crie uma conexão no seu SGBD, e dentro dela, execute o seguinte SQL: <br>
*create database contos;*<br>
*use contos;* <br>
*create table usuarios (* <br>
*id int primary key auto_increment,* <br>
*nome varchar(60),* <br>
*email varchar(60),* <br>
*senha varchar(16)* <br>
*);* <br>
*create table contos (* <br>
*id int primary key auto_increment,* <br>
*usuario_id int,* <br>
*titulo varchar(60),* <br>
*data_publicacao date,* <br>
*texto text,* <br>
*foreign key (usuario_id) references usuarios(id)* <br>
*);* <br>

3. Instale as dependências usando Composer<br>
No cmd: *composer install*

4. Rode a aplicação:<br>
No cmd: *php -S localhost:8000 -t public*

## Uso
Para usar esse projeto, siga esses passos:<br>
Abra o seu web browser e navega para http://localhost:8000. A partir dessa tela, que é a inicial do sistema web, você visualiza Todos os contos já feitos e enviados para o Banco de Dados e dali também você pode navegar para cadastro e login. Primeiro você deve se cadastrar para poder logar. Uma vez logado, abrirá, na barra de navegação, as opções para se criar um novo conto, ver seus contos já criados e fazer logout. Em "criar conto", você escreve um conto, o qual ficará disponível posteriormente para todos os usuários. Em "meus contos", você poderá atualizar ou deletar os seus contos já criados. Em logout, você é deslogado e retorna para a página inicial.

## Contribuir
Contributions are welcome! Please follow these steps to contribute: Contribuições são bem-vindas. Por favor, siga as seguintes instruções para contribuir: <br>
- Forque o repositório.
- Crie uma nova branch (git checkout -b feature/YourFeature). 
- Faça mudanças e depois dê um commit nelas (git commit -m 'Add some feature'). 
- Dê um push para a branch (git push origin feature/YourFeature). 
- Abra um pull request. 

## Contato
Para quaisquer questões ou feedback, sinta-se livre para me contatar: <br>
- Mateus R. Sachelaride - sachelaride.42




