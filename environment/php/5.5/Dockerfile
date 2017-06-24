FROM php:5.5

RUN apt-get update && apt-get install -y libpq-dev coreutils --no-install-recommends && rm -r /var/lib/apt/lists/*
RUN docker-php-ext-install pdo pdo_mysql pdo_pgsql
