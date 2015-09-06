FROM php:5.6-apache
RUN sed -i 's:DocumentRoot /var/www/html:DocumentRoot /var/www/html/public:' /etc/apache2/apache2.conf
RUN a2enmod rewrite
RUN pecl install xdebug
COPY xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini
VOLUME ["/var/www/html"]
