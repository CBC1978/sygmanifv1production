# Dockerfile
FROM php:7.2-fpm

# Installer les extensions nécessaires
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    curl \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

RUN docker-php-ext-install mysqli
RUN docker-php-ext-install mysqli pdo pdo_mysql



WORKDIR /var/www/html

COPY ./app /var/www/html

# Donner les droits
RUN chown -R www-data:www-data /var/www/html
