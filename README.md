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

Copy this into `php artisan tinker`. Create 5 random games and give them players.

```
factory('App\Game', 5)->create()->each(function ($g) { $users = factory('App\GamePlayer', 2)->create(['game_id' => $g->id]); $g->winner_id = $users->first()->id; $g->save(); });
```
