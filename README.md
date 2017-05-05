# Typonaut

This is a web based typing game built using Laravel, Vue and WebSockets (Pusher and Laravel Echo).

# Set up

Run these commands:

```
$ composer install
$ npm install
$ cp .env.example .env
$ php artisan key:generate
```

Create database and fill in the `.env` file variables including the Pusher parameters from `dashboard.pusher.com`.

Run migrations:

```
$ php artisan migrate
```

# How to run

Use Laravel Valet OR run this command:

```
$ php artisan serve
```

# Generate random data

```bash
# Create users and games
php artisan db:seed

# Create users
php artisan db:seed --class=UsersSeeder

# Create games
php artisan db:seed --class=GamesTableSeeder
```
