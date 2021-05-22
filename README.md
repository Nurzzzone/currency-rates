#### Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

#### Setup Docker
Docker containers:
```
cron
webserver (nginx)
app (laravel app)
db (mysql) 
```

### Commands
1.1 Create copy .env.example file to .env and setup your configuration  
1.2 Add your api key to CURRENCY_API_KEY from https://currate.ru/  
1.3 * if you're using docker-compose change DB_HOST to msql container_name (db)  
```
cp .env.example .env
```
2. Fill up mysql database, username, password fields in docker-compose.yml file
3. Run following commands
```
docker-compose up -d
docker-compose exec app composer install
docker-compose exec app npm install
docker-compose exec app npm run dev
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan migrate
```
4. (Optional) Run this command to get scheduled tasks (get currency rates data)
```
docker-compose exec app php artisan schedule:test #(optional) every hour get data
```

#### License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

