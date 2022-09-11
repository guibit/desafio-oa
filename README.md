
## Requisitos

- PHP 7.4 à 8.1
- Composer
- Package Node
- Postgres


## Instruções para baixar o Projeto e dependencias

- Git clone
- Configure seu arquivo .env para conexão com o banco
- Rodar os comandos

```
$ composer install
$ npm install
$ npm run dev
```

## Inicializando dados iniciais

```
php artisan migrate
php artisan db:seed
```
