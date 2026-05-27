FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libjpeg-dev

RUN docker-php-ext-install pdo pdo_mysql

RUN a2enmod rewrite

WORKDIR /var/www/html

COPY . .

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN composer install

RUN chown -R www-data:www-data /var/www/html

EXPOSE 80