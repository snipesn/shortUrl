FROM php:7.4-fpm

RUN apt-get update && apt-get upgrade -y &&  apt-get install libz-dev libzip-dev libpq-dev -y

RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

RUN docker-php-ext-install -j$(nproc) zip \
   && docker-php-ext-install -j$(nproc) pgsql \
   && docker-php-ext-install -j$(nproc) pdo_pgsql

WORKDIR /home
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"; php composer-setup.php; php -r "unlink('composer-setup.php');"

WORKDIR /var/www/html

CMD cp .env.example .env; php artisan key:generate; /home/composer.phar install; php artisan migrate; php-fpm 