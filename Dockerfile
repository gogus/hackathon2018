FROM php:7.2-apache

# install pdo
RUN docker-php-ext-install -j$(nproc) pdo_mysql

# enable mod rewrite
RUN a2enmod rewrite

# point apache to /var/www/web
RUN sed -ri -e 's!/var/www/html!/var/www/web!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!/var/www/web!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# point docker to app dir
WORKDIR /var/www
