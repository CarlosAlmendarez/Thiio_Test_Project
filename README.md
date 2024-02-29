## Instrucciones de Configuración

1. Clona este repositorio.
2. Ejecuta `composer install` para instalar el proyecto de laravel.
3. Ejecuta `npm install` para instalar node en el proyecto.
4. crear el archivo .env en la raiz del proyecto copiando el contenido de .env.example.
5. Ejecuta el comando `php artisan key:generate` para instalar la llave en el archivo .env.
6. Ejecuta `npm run dev` para compilar los paquetes de node.
7. En otra terminal ejecuta `php artisan serve` para correr el proyecto de manera local.
8. abre la direccion de tu localhost:8000 para visualizar el proyecto.

## Configuración de la Base de Datos

Este proyecto utiliza MySQL como base de datos. Asegúrate de tener MySQL instalado y luego configura las siguientes variables de entorno:

- `DB_HOST`: Host de la base de datos.
- `DB_DATABASE`: Nombre de la base de datos.
- `DB_USERNAME`: Nombre de usuario de la base de datos.
- `DB_PASSWORD`: Contraseña de la base de datos.

## Ejecución de Pruebas

Para ejecutar las pruebas, utiliza el siguiente comando:

```bash
composer artisan test