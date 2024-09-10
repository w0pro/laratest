FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libicu-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    && docker-php-ext-install intl opcache pdo pdo_mysql mbstring zip xml

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN mkdir /var/www/html/app

WORKDIR /var/www/html/app

COPY ../ .

WORKDIR /var/www/html/app/backend

RUN composer install --no-scripts --no-autoloader
RUN useradd --user-group --system --create-home --no-log-init www
RUN usermod -u 1000 www-data

RUN chown -R www-data:www-data storage
RUN chmod -R 777 storage/
RUN chown -R www-data:www-data bootstrap/cache

RUN php artisan key:generate

EXPOSE 9000

CMD ["php-fpm"]
