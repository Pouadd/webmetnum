# Use an official PHP runtime as the base image
FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libonig-dev \
    libzip-dev \
    libxml2-dev \
    git unzip curl \
    && docker-php-ext-install mbstring pdo pdo_mysql zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy application files
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Set file permissions
RUN chown -R www-data:www-data /app

# Expose port 8000
EXPOSE 8000

# Start PHP-FPM
CMD ["php-fpm"]
