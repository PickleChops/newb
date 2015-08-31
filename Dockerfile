FROM php:5.6-apache
#COPY config/php.ini /usr/local/etc/php/
RUN sed -i 's:DocumentRoot /var/www/html:DocumentRoot /var/www/html/public:' /etc/apache2/apache2.conf
VOLUME ["/var/www/html"]
