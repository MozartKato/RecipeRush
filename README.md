<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# RecipeRush

RecipeRush is a Laravel-based application for recipe management, featuring user authentication, an admin panel, and user info API.

## Features
- User Authentication (register, login, logout)
- Admin panel
- User info API

## Installation
1. Clone this repository
2. Run `composer install` and `npm install`
3. Copy `.env.example` to `.env` and configure your database settings
4. Run `php artisan key:generate`
5. Run migrations: `php artisan migrate`
6. Start the server: `php artisan serve`

## Usage
- Login endpoint: `POST /api/login`
- User info endpoint: `GET /api/user` (requires token)

## Contribution
Pull requests and issues are welcome.

## License
MIT