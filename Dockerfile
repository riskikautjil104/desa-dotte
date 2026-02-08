FROM php:8.1-fpm-alpine

# Install system dependencies
RUN apk add --no-cache \
    libzip-dev \
    unzip \
    git \
    curl \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    libxml2-dev \
    zip \
    bash \
    npm

# Install PHP extensions
RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    zip \
    tokenizer \
    json

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www/html

# Copy existing application directory contents
COPY . /var/www/html

# Install dependencies
RUN composer install --no-interaction --prefer-dist --no-dev

# Copy existing env file if exists, otherwise copy example
RUN if [ -f .env ]; then cp .env /var/www/html/.env; else cp .env.example /var/www/html/.env; fi

# Generate application key
RUN php artisan key:generate --force

# Clear cache
RUN php artisan config:cache

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port 8000
EXPOSE 8000

# Start Laravel server
CMD ["sh", "-c", "php artisan serve --host=0.0.0.0 --port=8000 && tail -f /dev/null"]

