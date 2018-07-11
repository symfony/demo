FROM php:7.2-fpm-alpine

# Install Symfony requirements
RUN \
    apk add --no-cache --virtual .persistent-deps \
        git \
        icu-libs \
        postgresql-libs \
        yarn \
        zlib-dev && \
    apk add --no-cache --virtual .build-deps \
        $PHPIZE_DEPS \
        icu-dev \
        postgresql-dev && \
    docker-php-ext-install -j$(nproc) \
        intl \
        opcache \
        pdo_pgsql \
        zip && \
    apk del .build-deps

# Install Composer globally
ENV COMPOSER_ALLOW_SUPERUSER 1
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html/
