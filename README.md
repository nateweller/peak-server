# Peak Server

The back-end Laravel application that supports the Peak ecosystem.

## Server Requirements

1. Apache or Nginx
2. PHP ^7.4
3. MySQL ^5.7

## Development Requirements

1. [Node.js](https://nodejs.org/en/)
2. [PHP](https://www.php.net/)
3. [Composer](https://getcomposer.org/)

## Installation

1. Clone the repository.
2. Run `composer install` in the root directory.
3. Copy `.env.example` into a new `.env` file, update as necessary.
4. Run `php artisan key:generate`,
6. Run `php artisan migrate` to install the database structure.
7. Run `php artisan passport:keys` to generate the encryption keys required by Laravel Passport.

## Local Development with Laravel Sail

1. Clone the repository.
1. Run `composer install` in the root directory.
3. Copy `.env.example` into a new `.env` file.
4. Run `php artisan key:generate`
1. Start [Laravel Sail](https://laravel.com/docs/9.x/sail) with `./vendor/bin/sail up`.
2. Run `./vendor/bin/sail artisan migrate` to install the database structure.
3. Run `./vendor/bin/sail artisan passport:keys` to generate the encryption keys required by Laravel Passport.