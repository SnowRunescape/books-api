FROM php:8.3-fpm

ENV PHP_OPCACHE_VALIDATE_TIMESTAMPS="0"

RUN apt-get update && \
    apt-get install -y libzip-dev && \
    apt-get clean && \
    docker-php-ext-install opcache pdo pdo_mysql zip

ADD opcache.ini "$PHP_INI_DIR/conf.d/opcache.ini"

WORKDIR /var/www

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

EXPOSE 9000

ENTRYPOINT ["php-fpm"]
