FROM dunglas/frankenphp

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN install-php-extensions \
    pdo_sqlite \
    intl \
    zip \
    opcache

COPY . /app
WORKDIR /app

# Copy custom Caddyfile
COPY Caddyfile /etc/caddy/Caddyfile

# Add entrypoint script
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Install ALL composer dependencies (including dev) to support APP_ENV=dev
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN composer install --no-interaction --no-scripts --optimize-autoloader

ENTRYPOINT ["/usr/local/bin/docker-entrypoint.sh"]
