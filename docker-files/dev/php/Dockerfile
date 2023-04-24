FROM php:8.2-fpm-alpine3.17

COPY --from=composer /usr/bin/composer /usr/bin/composer
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

RUN apk update && apk add --update linux-headers && apk add --no-cache zip unzip \
    && install-php-extensions zip xdebug \
    && cp /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini

COPY ./99-xdebug.ini /usr/local/etc/php/conf.d/99-xdebug.ini

WORKDIR /app
