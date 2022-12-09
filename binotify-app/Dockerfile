FROM php:apache
RUN apt-get update && docker-php-ext-install pdo_mysql
RUN a2enmod rewrite
ADD ./src /var/www/html/
COPY ./apache/apache2.conf /etc/apache2/apache2.conf