# This Dockerfile contains different images

ARG PHP_VERSION=8.0
ARG CADDY_VERSION=2

# Build PHP FPM

ARG APP_ENV=dev

FROM php:${PHP_VERSION}-fpm-alpine AS symfony_php

WORKDIR /srv/symfony
VOLUME /var/run/php
VOLUME /srv/symfony/var

# Install required PHP extensions
RUN set -eux; \
    apk add --no-cache \
    		$PHPIZE_DEPS \
    		icu-dev \
    	; \
     docker-php-ext-install intl

COPY docker/php/php-fpm.d/zz-docker.conf /usr/local/etc/php-fpm.d/zz-docker.conf

# Install composer
COPY --from=composer:2.0 /usr/bin/composer /usr/bin/composer

ENV COMPOSER_ALLOW_SUPERUSER=1
ENV PATH="${PATH}:/root/.composer/vendor/bin"

# copy only specifically what we need
COPY composer.json composer.lock symfony.lock ./
COPY assets assets/
COPY bin bin/
COPY config config/
COPY data data/
COPY migrations migrations/
COPY public public/
COPY src src/
COPY templates templates/
COPY tests tests/
COPY translations translations/
COPY .env .env.test webpack.config.js yarn.lock ./

RUN set -eux; \
	composer install --prefer-dist --no-progress; \
	composer clear-cache


RUN set -eux; \
	mkdir -p var/cache var/log; \
	composer dump-autoload --classmap-authoritative ; \
	composer run-script post-install-cmd; \
	chmod +x bin/console; sync


# Build Caddy image
FROM caddy:${CADDY_VERSION}-builder-alpine AS symfony_caddy_builder

RUN xcaddy build

FROM caddy:${CADDY_VERSION} AS symfony_caddy
WORKDIR /srv/symfony

COPY --from=symfony_caddy_builder /usr/bin/caddy /usr/bin/caddy
COPY --from=symfony_php /srv/symfony/public public/
COPY docker/caddy/Caddyfile /etc/caddy/Caddyfile

