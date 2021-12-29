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
      apt-utils \
    && docker-php-ext-install intl opcache pdo pdo_mysql \
    && pecl install apcu \
    && docker-php-ext-enable apcu \
    && docker-php-ext-install gd \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip

COPY composer.phar /var/www/debeersfyf/
RUN mv /var/www/debeersfyf/composer.phar /usr/local/bin/composer
RUN /usr/local/bin/composer | php --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/debeersfyf
