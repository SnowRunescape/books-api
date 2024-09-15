# book-api

Projeto API de um sistema de livros 😊

Quer testar a api? temos uma demostração aqui: https://book-api.snowdev.com.br/

login: SnowRunescape
senha: 123456

nem pense em trocar a senha 😁

# Como Usar?

* Copie o `.env.example` para `.env`, e adicione as credenciais (qualquer uma) em `DATABASE_PASSWORD` e `JWT_SECRET`.
* Execute o Docker `docker-compose up -d`.
* crie as tabelas no banco de dados `php yii migrate`.
* Crie um usuario pelo CLI, utilizando `php yii user/create-user {login} {password} {name}`.

Há um arquivo para realizar os testes com o [Postman Collection](https://github.com/SnowRunescape/books-api/blob/master/Book-API.postman_collection.json).

## Rotas API

`/auth/login` - Realiza o login no sistema

`/clients` - lista os clientes

`/books` - lista os livros

`/upload` - realiza o upload de imagens
