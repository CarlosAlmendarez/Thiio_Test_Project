## Setup Instructions

1. Clone this repository.
2. Run `composer install` to install the Laravel project.
3. Run `npm install` to install Node in the project.
4. Create the .env file in the root of the project by copying the contents of .env.example.
5. Run the command `php artisan key:generate` to install the key in the .env file.
6. Run `npm run dev` to compile the node packages.
7. In another terminal, run `php artisan serve` to run the project locally.
8. Open your localhost:8000 address to view the project.

## Database configuration

This project uses MySQL as the database. Make sure you have MySQL installed and then configure the following environment variables:

- `DB_CONNECTION`=mysql
- `DB_HOST`=127.0.0.1
- `DB_PORT`=3306
- `DB_DATABASE`=laravel
- `DB_USERNAME`=root
- `DB_PASSWORD`=

## Running test

To run the tests, use the following command:

```bash
composer artisan test