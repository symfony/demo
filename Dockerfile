FROM php:8.3-fpm-alpine

# Install system dependencies
RUN apk add --no-network --no-cache \
    icu-dev libzip-dev zlib-dev bash

# Install PHP extensions
RUN docker-php-ext-install intl opcache zip

# Get Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

# Set permissions for Symfony
RUN chown -R www-data:www-data /var/www/html