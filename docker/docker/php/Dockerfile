FROM php:8.4-fpm

# Install system dependencies (including build deps for zip/gd)
RUN apt-get update && apt-get install -y \
    git \
    curl \
    gnupg2 \
    ca-certificates \
    lsb-release \
    pkg-config \
    zlib1g-dev \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    wget

# Install Node.js (LTS) so npm/yarn are available
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
 && apt-get install -y nodejs

# Clear apt cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Configure & install PHP extensions (gd requires jpeg/freetype config)
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
 && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Install Composer binary from official composer image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install Laravel installer globally so `laravel` command is available
RUN composer global require laravel/installer --no-interaction --prefer-dist \
 && ln -s /root/.composer/vendor/bin/laravel /usr/local/bin/laravel 2>/dev/null || true \
 && ln -s /root/.config/composer/vendor/bin/laravel /usr/local/bin/laravel 2>/dev/null || true

WORKDIR /var/www/html

USER root
