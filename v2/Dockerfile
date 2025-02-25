# Use an official PHP 8.2 image as the base
FROM php:8.2-cli

# Install dependencies required for Symfony Console
RUN apt-get update && apt-get install -y libzip-dev unzip git libxml2-dev

# Install PHP extensions
RUN docker-php-ext-install zip xml

# Install Composer (copy it from the official Composer image)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set the working directory
WORKDIR /var/www

# Copy the entire application into the container
COPY . .

# Install Composer dependencies
RUN composer install --no-interaction

# Default command: start an interactive bash shell so you can run commands manually
CMD ["bash"]