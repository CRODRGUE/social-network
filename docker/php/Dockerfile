FROM php:8.1-apache

COPY .htaccess /var/www/html/

RUN apt-get update && \
    docker-php-ext-install mysqli pdo pdo_mysql
RUN apt-get -y install sudo

RUN sudo a2enmod rewrite && sudo service apache2 restart