# API do projeto de cadastro de vendas e cálculo de comissões

O backend do projeto consiste em uma API Rest que se comunica com um banco MySQL e foi desenvolvido em PHP utilizando o framework Laravel. É possível acessar a documentação da API após rodar o projeto através da rota: http://127.0.0.1:8092/api/documentation

## 🚀 Setup do projeto

### 🔧 Instalação

Para instalar as dependências da API, rode o comando:

```
composer install
```

Para iniciar a API, rode o comando:

```
php artisan serve --port=8092
```

Para criar as tabelas no banco rode o comando:

```
php artisan migrate
```

Para popular as tabelas do banco rode o comando:

```
php artisan db:seed
```

## 📄 Banco de dados

Para o projeto foi utilizado o MySQL Workbench para gerenciamento, na Local Instance MySQL80 com as seguintes informações:

* Hostname: localhost
* Port: 3306
* Username: root
* Password: admin
* Database: sales_comission_system

## ⚙️ Testes

Para executar os testes da API, rode o comando:

```
php artisan test
```

## 🛠️ Construído com

* [PHP](https://www.php.net/)
* [Laravel](https://laravel.com/)

---
Desenvolvido com ❤️ e muito ☕ por [Lucas Gomide](https://github.com/gomidx)