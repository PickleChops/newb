FROM php:5.6-apache
RUN cp /usr/src/php/php.ini-development /usr/local/etc/php/php.ini

RUN pecl install xdebug
COPY xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

RUN a2enmod rewrite
RUN sed -i 's:DocumentRoot /var/www/html:DocumentRoot /var/www/html/public:' /etc/apache2/apache2.conf

VOLUME ["/var/www/html"]
