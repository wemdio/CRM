FROM dunglas/frankenphp

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN install-php-extensions \
    pdo_pgsql \
    intl \
    zip \
    opcache

COPY . /app
WORKDIR /app

# Add entrypoint script
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Install composer dependencies (optimized for prod)
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN composer install --no-dev --optimize-autoloader

ENTRYPOINT ["/usr/local/bin/docker-entrypoint.sh"]
