#!/bin/sh
set -e

# Pastikan folder storage dan bootstrap cache writable
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database

# Jika menggunakan SQLite, pastikan file database ada
if [ "$DB_CONNECTION" = "sqlite" ] || [ -z "$DB_CONNECTION" ]; then
    mkdir -p /var/www/html/database
    if [ ! -f /var/www/html/database/database.sqlite ]; then
        touch /var/www/html/database/database.sqlite
    fi
    chown -R www-data:www-data /var/www/html/database
fi

# Link storage
php artisan storage:link --force || true

# Jalankan migrasi database
php artisan migrate --force

# Optimasi cache Laravel
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Jalankan PHP-FPM di background
php-fpm -D

# Jalankan Nginx di foreground
exec nginx -g "daemon off;"
