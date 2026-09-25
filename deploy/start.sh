#!/bin/sh
set -eu
: "${APP_KEY:?APP_KEY is required}"
: "${DB_HOST:?DB_HOST is required}"
: "${DB_PASSWORD:?DB_PASSWORD is required}"
php artisan config:cache
php artisan view:cache
chown -R www-data:www-data storage bootstrap/cache
exec apache2-foreground
