# Test checkout with Placetopay

Este proyecto prueba pagar un producto usando la pasarela de pagos Placetopay

## Requisitos

- Despues de clonar el respositorio crear el .env

```shell
cp .env.example .env
```

- Colocar los valores de las variables en el archivo .env PLACETOPAY_LOGIN, PLACETOPAY_TRANKEY,   PLACETOPAY_BASE_URL
- Configurar los datos de conexión para la base de datos
- Instalar dependencias, ejecutar migraciones y crear application key
```shell
composer install
php artisan migrate --seed
php artisan key:generate
```

## Rutas

- Para ver todas las ordenes **/admin/orders**
- El home **/** donde inicia el proceso de creación de una nueva orden

## Visualizar

Para iniciar el server de pruebas

```shell
php artisan serve
```

## Tests
Para ejecutar los tests

```shell
php artisan test
```
