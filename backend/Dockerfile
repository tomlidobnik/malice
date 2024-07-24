# Use the official PHP image with Apache
FROM php:7.4-apache

# Install system dependencies for PDO PostgreSQL
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql

# Copy your PHP files to the default Apache serve directory
COPY . /var/www/html/

# Apache is already configured to serve from /var/www/html