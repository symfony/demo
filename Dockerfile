FROM php:7.2.9-apache

RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev

RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

COPY . /app

RUN chown www-data /app/var \
	&& rmdir /var/www/html \
	&& ln -s /app/public /var/www/html

EXPOSE 80
