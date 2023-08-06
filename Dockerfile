# Use an official PHP 5.6 image with Alpine Linux
FROM php:5.6-fpm-alpine

# Set the working directory inside the container
WORKDIR /var/www/html

# Install system dependencies
RUN apk add --update --no-cache libpng-dev libjpeg-turbo-dev freetype-dev zip unzip nginx libmcrypt-dev

# Install PHP extensions
RUN docker-php-ext-install -j$(nproc) gd
RUN docker-php-ext-install pdo pdo_mysql mcrypt

# Copy application code into the container
COPY . .

# Copy Nginx configuration
COPY nginx.conf /etc/nginx/nginx.conf

# Set permissions for Laravel files and directories
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port 80 for Nginx
EXPOSE 80

# Start Nginx and PHP-FPM
CMD ["sh", "-c", "nginx && php-fpm"]
