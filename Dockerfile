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

# Install composer dependencies (update to sync lock file, no scripts to avoid build-time errors)
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN composer update --no-dev --optimize-autoloader --no-scripts

ENTRYPOINT ["/usr/local/bin/docker-entrypoint.sh"]
