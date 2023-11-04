# API do projeto de cadastro de vendas e cálculo de comissões

O backend do projeto consiste em uma API Rest que se comunica com um banco MySQL e foi desenvolvido em PHP utilizando o framework Laravel. É possível acessar a documentação da API após rodar o projeto através da rota: http://localhost:8000/api/documentation

Para a documentação foi utilizada a biblioteca [L5-Swagger](https://github.com/DarkaOnLine/L5-Swagger).

Para a autenticação da API foi utilzado o [Sanctum](https://laravel.com/docs/10.x/sanctum), e é necessário passar um header de Authorization: Bearer {token} nas requisições.

Para autenticar as requisições no Swagger, basta criar um usuário administrador informando o nome, e-mail e senha; após isso gere o bearer token através da rota /token informando o e-mail e a senha e informe o token no botão "Authorize" no canto superior direito da página da Swagger.

## 🚀 Setup do projeto

### 🔧 Iniciar

Para iniciar a API, basta executar o comando:

```
sudo make run-app-with-setup
```

Com esse comando, as migrations e os seeders também serão executados. Pronto! A API estará rodando na URL http://localhost:8000

Para derrubar a API, execute o comando:

```
sudo make kill-app
```

Atenção: todos os comandos devem ser executados na raíz do projeto.

## ⚙️ Testes

Para executar os testes da API, rode o comando:

```
sudo make run-tests
```

## 🛠️ Construído com

* [PHP](https://www.php.net/)
* [Laravel](https://laravel.com/)
* [Docker](https://www.docker.com/)

---
Desenvolvido com ❤️ e muito ☕ por [Lucas Gomide](https://github.com/gomidx)