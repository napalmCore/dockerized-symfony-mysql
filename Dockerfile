# Dockerfile for Symfony
FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpq-dev \
    libzip-dev \
    zip \
    && docker-php-ext-install pdo pdo_mysql zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/symfony

# Copy Symfony application to the container
COPY ./symfony .

# Install Composer dependencies
RUN composer install --no-scripts

# Expose port 9000 for PHP-FPM
EXPOSE 9000
