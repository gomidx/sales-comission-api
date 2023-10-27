## API do projeto Sistema de Vendas e Comissões

Para executar a API é necessário rodar os seguintes comandos:

php artisan serve --port=8092
php artisan migrate
php artisan db:seed

Para executar os testes, basta rodar o comando:

php artisan test


Banco de dados:

MySQL Workbench
DB_Host: 127.0.0.1
DB_Port: 3306
DB_Name: sales_comission_system
DB_User: root
DB_Password: admin