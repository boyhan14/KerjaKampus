# Stage 1: Build Frontend Assets (Vite & Tailwind)
FROM node:20-alpine AS node_builder
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

# Stage 2: Install Composer Dependencies
FROM composer:2 AS composer_builder
WORKDIR /app
COPY composer*.json ./
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist --ignore-platform-reqs
COPY . .
RUN composer dump-autoload --optimize --no-dev

# Stage 3: Production PHP + Nginx Runtime
FROM php:8.4-fpm-alpine

# Install Nginx and required PHP extensions
RUN apk add --no-cache \
    nginx \
    curl \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    libzip-dev \
    zip \
    unzip \
    sqlite-dev \
    oniguruma-dev \
    icu-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        pdo \
        pdo_sqlite \
        pdo_mysql \
        mbstring \
        gd \
        zip \
        intl \
        opcache \
        bcmath

WORKDIR /var/www/html

# Copy application files
COPY . .

# Copy vendor from composer_builder
COPY --from=composer_builder /app/vendor /var/www/html/vendor

# Copy built public assets from node_builder
COPY --from=node_builder /app/public/build /var/www/html/public/build

# Copy Nginx config and entrypoint
COPY docker/nginx.conf /etc/nginx/http.d/default.conf
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database

EXPOSE 80

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
