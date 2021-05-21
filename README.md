#### Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

#### Commands 
```
cp .env.example .env
docker-compose up -d
docker-compose exec app composer install
docker-compose exec app npm install
docker-compose exec app npm run dev
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan migrate
docker-compose exec app php artisan schedule:test #(optional) every hour get data
```

#### License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

