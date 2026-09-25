FROM node:22-bookworm-slim AS assets
WORKDIR /app
COPY package.json package-lock.json ./
RUN npm ci
COPY resources ./resources
COPY vite.config.js tailwind.config.js postcss.config.js ./
RUN npm run build

FROM php:8.3-apache-bookworm AS runtime
RUN apt-get update && apt-get install -y --no-install-recommends libpq-dev libonig-dev libzip-dev libxml2-dev unzip \
    && docker-php-ext-install pdo_pgsql mbstring bcmath opcache zip dom xml \
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*
COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer
WORKDIR /var/www/html
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist --no-interaction
COPY . .
COPY --from=assets /app/public/build ./public/build
COPY deploy/apache.conf /etc/apache2/sites-available/000-default.conf
COPY deploy/php.ini /usr/local/etc/php/conf.d/rachi.ini
RUN sed -i 's/Listen 80/Listen 8080/' /etc/apache2/ports.conf \
    && mkdir -p bootstrap/cache storage/framework/cache/data storage/framework/sessions storage/framework/views storage/logs storage/app/public \
    && composer dump-autoload --no-dev --optimize --no-scripts \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod +x deploy/start.sh
ENV APP_ENV=production APP_DEBUG=false LOG_CHANNEL=stderr DB_CONNECTION=pgsql DB_SSLMODE=require QUEUE_CONNECTION=sync CACHE_STORE=file
EXPOSE 8080
CMD ["sh", "deploy/start.sh"]
