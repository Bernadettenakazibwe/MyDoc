# PHP + Apache
FROM php:8.2-apache

# Enable MySQL extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Optional: enable mod_rewrite
RUN a2enmod rewrite

# App files
WORKDIR /var/www/html
COPY . /var/www/html

# (Simple) permissions
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
