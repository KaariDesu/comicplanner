FROM php:8.1-apache
WORKDIR /var/www/html
COPY . /var/www/html
RUN a2enmod rewrite
COPY apache-config.conf /etc/apache2/sites-available/000-default.conf
RUN docker-php-ext-install pdo pdo_mysql fileinfo
EXPOSE 80
CMD ["apache2-foreground"]