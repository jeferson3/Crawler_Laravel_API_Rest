## Processo de instalação e configuração

Requisitos:
- PHP 8.
- Composer 2+.
- Myslq

Instalação:
- Clonar o repositório
- Instalar as dependências (composer install)
- Criar chave (php artisan key:generate)
- Criar banco de dados, importar(database/laravel.sql.gz) ou rodar a migration (php artisan:migrate)
- Iniciar servidor (php artisan serve)
- Iniciar crauler (php artisan schedule:work)
- Acessar endpoint api (http://localhost:8000/api/documentation)
