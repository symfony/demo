# Dockerfile
FROM php:8.1-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip \
    libzip-dev \
    && docker-php-ext-install zip pdo_mysql

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy application code
COPY . .

# Install PHP dependencies
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Set permissions
RUN chown -R www-data:www-data /var/www/html/var && chmod -R 775 /var/www/html/var

# Expose port 80
EXPOSE 80

# Configure Apache (optional, if you need custom config)
# COPY apache2.conf /etc/apache2/sites-available/000-default.conf

# Start Apache
CMD ["apache2-foreground"]