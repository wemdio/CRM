FROM dunglas/frankenphp

RUN install-php-extensions \
    pdo_pgsql \
    intl \
    zip \
    opcache

COPY . /app
WORKDIR /app

CMD [ "frankenphp", "run", "--config", "/etc/caddy/Caddyfile" ]

