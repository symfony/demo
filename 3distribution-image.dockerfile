FROM fyfsystemimage as fyfdistributionimage

RUN apt update && \
    apt install -y \
      g++ \
      git \
      libfreetype6-dev \
      libicu-dev \
      libjpeg62-turbo-dev \
      libpng-dev \
      libzip-dev \
      zip \
      zlib1g-dev \
    && docker-php-ext-install intl opcache pdo pdo_mysql \
    && pecl install apcu \
    && docker-php-ext-enable apcu \
    && docker-php-ext-install gd \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip

WORKDIR /var/www/debeersfyf
