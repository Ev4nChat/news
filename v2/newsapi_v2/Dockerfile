# Use an official PHP 8.2 image as the base
FROM php:8.2-cli

# Install dependencies required for Symfony
RUN apt-get update && apt-get install -y libzip-dev unzip git libxml2-dev

# Install PHP extensions
RUN docker-php-ext-install zip xml

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set the working directory
WORKDIR /var/www

# Copy the Symfony application into the container
COPY . .

# Install dependencies
RUN composer install --no-interaction

# Expose the port
EXPOSE 8000

# Default command to run Symfony server
CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]
