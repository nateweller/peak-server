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

1. Clone the repository 
2. Run `composer install` in the root directory
3. Copy `.env.example` into a new `.env` file
4. Run `php artisan key:generate`
5. Create a MySQL database on your local server and update the `.env` file accordingly.
6. Run `php artisan:migrate` to install the database structure.