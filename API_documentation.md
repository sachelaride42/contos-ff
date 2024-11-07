# Documentação das Rotas e Endpoints

Este documento descreve as rotas e endpoints disponíveis na aplicação, facilitando a integração com o back-end em PHP.

## Rotas da Aplicação

### Páginas Principais

| Método | Endpoint             | Descrição                      | Controlador                | Ação                |
|--------|----------------------|-------------------------------|----------------------------|---------------------|
| GET    | `/`                  | Página inicial                | HomeController             | index               |
| GET    | `/login`             | Formulário de login           | UserController             | loginForm           |
| GET    | `/cadastro`          | Formulário de cadastro        | UserController             | registerForm        |
| GET    | `/criar-conto`       | Formulário para criar conto   | ContosController           | createForm          |
| GET    | `/meus-contos`       | Meus contos                   | ContosController           | myContos            |
| GET    | `/contos`            | Todos os contos               | ContosController           | allContos           |

### APIs de CRUD para Usuários

| Método | Endpoint                       | Descrição                      | Controlador                | Ação                |
|--------|--------------------------------|-------------------------------|----------------------------|---------------------|
| POST   | `/api/usuarios`               | Realiza login do usuário      | UserController             | login               |
| POST   | `/api/usuarios/cadastro`      | Registra um novo usuário      | UserController             | register            |

### APIs de CRUD para Contos

| Método | Endpoint                       | Descrição                      | Controlador                | Ação                |
|--------|--------------------------------|-------------------------------|----------------------------|---------------------|
| POST   | `/api/contos`                 | Cria um novo conto            | ContosController           | create              |
| GET    | `/api/contos`                 | Lista todos os contos         | ContosController           | index               |
| GET    | `/api/contos/:id`             | Exibe um conto específico     | ContosController           | show                |
| PUT    | `/api/contos/:id`             | Atualiza um conto específico   | ContosController           | update              |
| DELETE | `/api/contos/:id`             | Remove um conto específico     | ContosController           | destroy             |

## Observações

- Os endpoints que incluem `:id` são dinâmicos e devem ser substituídos pelo ID do recurso correspondente.
- As respostas das APIs retornam dados em formato JSON, com um status que indica sucesso ou erro e uma mensagem descritiva.
