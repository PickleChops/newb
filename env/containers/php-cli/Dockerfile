FROM php:5.6-cli

ENV XDEBUG_CONFIG "\"idekey=12345\""
ENV PHP_IDE_CONFIG="\"serverName=docker\""
EXPOSE 9000

# Install modules
RUN docker-php-ext-install mbstring

RUN cp /usr/src/php/php.ini-development /usr/local/etc/php/php.ini

RUN pecl install xdebug
COPY xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini


