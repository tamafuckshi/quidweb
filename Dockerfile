# Use an official PHP image as the base image
FROM php:8.0-apache

# Enable apache mod_rewrite for pretty URLs
RUN a2enmod rewrite

# Install PDO extensions for MySQL
RUN docker-php-ext-install pdo pdo_mysql

# Optionally, copy a custom php.ini configuration if needed
COPY ./php.ini /usr/local/etc/php/

# Set the working directory inside the container
WORKDIR /var/www/html

# Copy the content of the current directory to the container's /var/www/html
COPY . /var/www/html/

# Set proper file permissions (optional)
RUN chown -R www-data:www-data /var/www/html

# Expose port 80 for web traffic
EXPOSE 80

# Restart Apache to apply any changes to the config
CMD ["apache2-foreground"]
