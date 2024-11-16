# Use an official PHP image as the base image
FROM php:8.0-apache

# Enable apache mod_rewrite for pretty URLs
RUN a2enmod rewrite

# Set the working directory inside the container
WORKDIR /var/www/html

# Copy the content of the current directory to the container's /var/www/html
COPY ./public /var/www/html
COPY ./assets /var/www/assets
COPY ./config /var/www/config
COPY ./homepage /var/www/homepage

# Expose port 80 for web traffic
EXPOSE 80
