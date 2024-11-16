# Contos-ff

## Descrição

Esse projeto é um website que tem como objetivo a criação e o compartilhamento de contos de ficção fantástica e ficção científica, permite que o cadastro e login de usuários, a visualização de contos feitos por outros usuários, e a criação, atualização ou deleção dos contos feitos por um usuário. Ele foi projetado para pessoas de todas as idades que gostem de ler e / ou  escrever contos de ficção. 

**Tecnologias:** front-end (HTML com Materialize); back-end: PHP

**Dependências:** composer, phpunit, MySQL

**Diagrama ER:** https://drive.google.com/file/d/1euFVSPDhHzlfEtlKPEJ-hGYBVf4egvR4/view?usp=drive_link

## Tabela de conteúdos

- [Pré-requisitos](#prerequisites)
- [Instalação](#installation)
- [Uso](#usage)
- [Contribuir](#contributing)
- [Licença](#license)
- [Contato](#contact)

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

1. Clone o repositório:
   No cmd:
   *git clone https://github.com/sachelaride42/contos-ff.git
   cd contos-ff
   cd projeto*

3. Crie uma conexão no seu SGBD, e dentro dela, execute o seguinte SQL: 
*create database contos;*
*use contos;*
*create table usuarios (*
*id int primary key auto_increment,*
*nome varchar(60),*
*email varchar(60),*
*senha varchar(16)
);*

*create table contos (
id int primary key auto_increment,
usuario_id int,
titulo varchar(60),
data_publicacao date,
texto text,
foreign key (usuario_id) references usuarios(id)
);*

2. Instale as dependências usando Composer
No cmd: *composer install*

3. Run the application:
No cmd: *php -S localhost:8000 -t public*

##Usage
To use this project, follow these steps:

Open your web browser and navigate to http://localhost:8000.

[Provide a brief explanation of how to use the main features of your project. Include code snippets or examples if applicable.]

