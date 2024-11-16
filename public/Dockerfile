# Use the official PHP image as the base
FROM php:8.1-apache

# Install dependencies required for PostgreSQL support
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

# Copy application files to the Apache web root
COPY . /var/www/html/

# Set permissions for the web root
RUN chown -R www-data:www-data /var/www/html

# Expose the port Apache will run on
EXPOSE 80

# Start Apache server
CMD ["apache2-foreground"]



