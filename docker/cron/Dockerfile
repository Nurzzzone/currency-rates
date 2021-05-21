FROM php:7.4-fpm

RUN apt-get update && apt-get install -y cron
RUN docker-php-ext-install pdo_mysql

COPY ./docker/cron/crontab /etc/crontabs/root

CMD ["crond", "-f"]