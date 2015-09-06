FROM php:5.6-apache
RUN cp /usr/src/php/php.ini-development /usr/local/etc/php/php.ini

RUN pecl install xdebug
COPY xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

# Add a user for Apache2
RUN useradd -u 1000 -g 50 docker

# Use the uid 1000 & gid 50 for Apache2
RUN sed -i 's/User www-data/User docker/' /etc/apache2/apache2.conf
RUN sed -i 's/Group www-data/Group staff/' /etc/apache2/apache2.conf

RUN a2enmod rewrite
RUN sed -i 's:DocumentRoot /var/www/html:DocumentRoot /var/www/html/public:' /etc/apache2/apache2.conf

VOLUME ["/var/www/html"]
