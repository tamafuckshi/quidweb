# Use an official PHP image as the base image
FROM php:8.0-apache

# Enable apache mod_rewrite for pretty URLs
RUN a2enmod rewrite

# Set the working directory inside the container
WORKDIR /var/www/html

# Copy the content of the current directory to the container's /var/www/html
COPY . /var/www/html/

# Expose port 80 for web traffic
EXPOSE 80
