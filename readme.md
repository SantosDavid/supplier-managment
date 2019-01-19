# Projeto para gerenciamento de fornecedores

### Regras de negócio:

    1 - Para utilizar a API o usuário deve estar cadastrado e autenticado no sistema.

    2 - Após o usuário cadastrar um fornecedor, o sistema deve enviar um e-mail para o mesmo, neste e-mail existirá um link de ativação do fornecedor.


### Funcionalidades:

    1 - Cadastro de empresas/clientes

    2 - CRUD de fornecedores

    3 - Endpoint mostrando o resultante da soma de todas as mensalidades dos fornecedores da empresa.


## Para executar o projeto

    1 - Faça um clone: git clone ....

    2 - docker-compose up

    3 - docker-compose run app composer install

    4 - Crie e configure o arquivo .env

    5 - docker-compose run app php artisan key:generate

    6 - docker-compose run app php artisan jwt:secret

    7 - docker-compose run app php artisan migrate --seed

## Verificar coding style

    1 - docker-compose run app  ./vendor/bin/phpcbf app/ --standard=PSR2


## Testes

    1 - docker-compose run app php artisan migrate --seed --env=testing
    
    2 - docker-compose run app vendor/bin/phpunit


### Acesso

    Para cadastrar um empresa é necessário estar logado como administrador.

    O admin default é:

    **email**: admin@admin.com.br

    **senha**: 123456



### Referência Api

 **[Docs](https://documenter.getpostman.com/view/2449719/RznJnwcy)**