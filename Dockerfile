FROM php:8.2-fpm

# Install system deps
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libcurl4-openssl-dev \
    libssl-dev \
    pkg-config \
    libz-dev \
    && rm -rf /var/lib/apt/lists/*

# Install and enable mongodb php extension
RUN pecl channel-update pecl.php.net \
    && pecl install mongodb \
    && docker-php-ext-enable mongodb

# Install composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy composer files first for better cache
COPY composer.json composer.lock ./
RUN composer install --no-dev --prefer-dist --optimize-autoloader --no-interaction

# Copy the rest of the app
COPY . .

# Ensure storage directories exist and permissions
RUN mkdir -p storage/framework/cache data && \
    chown -R www-data:www-data storage bootstrap/cache

EXPOSE 8000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
