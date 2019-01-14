ARG NODE_VERSION=11.6.0
ARG COMPOSER_VERSION=1.8.0
ARG PHP_VERSION=7.2.13
ARG ICU_VERSION=63.1
ARG APCU_VERSION=5.1.16
ARG XDEBUG_VERSION=2.6.1


#####################################
##               APP               ##
#####################################
FROM php:${PHP_VERSION}-fpm as app

ARG ICU_VERSION
ARG APCU_VERSION

# Used for the ICU compilation
ENV PHP_CPPFLAGS="${PHP_CPPFLAGS} -std=c++11"
ENV APP_VERSION=0.0.0

WORKDIR /app

# Install paquet requirements
RUN set -ex; \
    # Install required system packages
    apt-get update; \
    apt-get install -qy --no-install-recommends \
            zlib1g-dev \
            git \
    ; \
    # Compile ICU (required by intl php extension)
    curl -L -o /tmp/icu.tar.gz http://download.icu-project.org/files/icu4c/${ICU_VERSION}/icu4c-$(echo ${ICU_VERSION} | sed s/\\./_/g)-src.tgz; \
    tar -zxf /tmp/icu.tar.gz -C /tmp; \
    cd /tmp/icu/source; \
    ./configure --prefix=/usr/local; \
    make clean; \
    make; \
    make install; \
    #Install the PHP extensions
    docker-php-ext-configure intl --with-icu-dir=/usr/local; \
    docker-php-ext-install -j "$(nproc)" \
            intl \
            pdo \
            # pdo_mysql \ Uncomment it to use MySQL, and remove the pdo_sqlite (see: docker-compose.yml, docker-compose.override.yml.dist)
            zip \
            bcmath \
    ; \
    pecl install \
            apcu-${APCU_VERSION} \
    ; \
    docker-php-ext-enable \
            opcache \
            apcu \
    ; \
    docker-php-source delete; \
    # Clean aptitude cache and tmp directory
    apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*;

## set recommended PHP.ini settings
RUN { \
        echo 'date.timezone = Europe/Paris'; \
        echo 'short_open_tag = off'; \
        echo 'expose_php = off'; \
        echo 'error_log = /proc/self/fd/2'; \
        echo 'memory_limit = 128m'; \
        echo 'post_max_size = 110m'; \
        echo 'upload_max_filesize = 100m'; \
        echo 'opcache.enable = 1'; \
        echo 'opcache.enable_cli = 1'; \
        echo 'opcache.memory_consumption = 256'; \
        echo 'opcache.interned_strings_buffer = 16'; \
        echo 'opcache.max_accelerated_files = 20011'; \
        echo 'opcache.fast_shutdown = 1'; \
        echo 'realpath_cache_size = 4096K'; \
        echo 'realpath_cache_ttl = 600'; \
    } > /usr/local/etc/php/php.ini

RUN { \
        echo 'date.timezone = Europe/Paris'; \
        echo 'short_open_tag = off'; \
        echo 'memory_limit = 8192M'; \
    } > /usr/local/etc/php/php-cli.ini

CMD ["php-fpm"]


#####################################
##             APP DEV             ##
#####################################
FROM app as app-dev

ARG NODE_VERSION
ARG COMPOSER_VERSION
ARG XDEBUG_VERSION

ENV COMPOSER_ALLOW_SUPERUSER=1
ENV APP_ENV=dev

# Install paquet requirements
RUN set -ex; \
    # Install required system packages
    apt-get update; \
    apt-get install -qy --no-install-recommends \
            unzip \
    ; \
    # Clean aptitude cache and tmp directory
    apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*;

# Install Node
RUN set -ex; \
    curl -L -o /tmp/nodejs.tar.gz https://nodejs.org/dist/v${NODE_VERSION}/node-v${NODE_VERSION}-linux-x64.tar.gz; \
    tar xfvz /tmp/nodejs.tar.gz -C /usr/local --strip-components=1; \
    rm -f /tmp/nodejs.tar.gz; \
    npm install yarn -g

# Install Composer
RUN set -ex; \
    EXPECTED_SIGNATURE="$(curl -L https://getcomposer.org/download/${COMPOSER_VERSION}/composer.phar.sha256sum)"; \
    curl -L -o composer.phar https://getcomposer.org/download/${COMPOSER_VERSION}/composer.phar; \
    ACTUAL_SIGNATURE="$(sha256sum composer.phar)"; \
    if [ "$EXPECTED_SIGNATURE" != "$ACTUAL_SIGNATURE" ]; then >&2 echo 'ERROR: Invalid installer signature' && rm /usr/local/bin/composer && exit 1 ; fi; \
    chmod +x composer.phar && mv composer.phar /usr/local/bin/composer; \
    RESULT=$?; \
    exit $RESULT;

# Edit OPCache configuration
RUN set -ex; \
    { \
        echo 'opcache.validate_timestamps = 1'; \
        echo 'opcache.revalidate_freq = 0'; \
    } >> /usr/local/etc/php/php.ini

# Install Xdebug
RUN set -ex; \
    if [ "${XDEBUG_VERSION}" != 0 ]; \
    then \
        pecl install xdebug-${XDEBUG_VERSION}; \
        docker-php-ext-enable xdebug; \
        { \
            echo 'xdebug.remote_enable = on'; \
            echo 'xdebug.remote_connect_back = on'; \
        } >> /usr/local/etc/php/php.ini \
    ; fi


#####################################
##       PROD ASSETS BUILDER       ##
#####################################
FROM node:${NODE_VERSION} as assets-builder

COPY . /app
WORKDIR /app

RUN yarn install && yarn build && rm -R node_modules

#####################################
##       PROD VENDOR BUILDER       ##
#####################################
FROM composer:${COMPOSER_VERSION} as vendor-builder

COPY --from=assets-builder /app /app
WORKDIR /app

RUN APP_ENV=prod composer install -o -n --no-ansi --no-dev


#####################################
##             APP PROD            ##
#####################################
FROM app as app-prod

ENV APP_ENV=prod

COPY --from=vendor-builder /app /app
WORKDIR /app

# Edit OPCache configuration
RUN set -ex; \
    { \
        echo 'opcache.validate_timestamps = 0'; \
    } >> /usr/local/etc/php/php.ini
