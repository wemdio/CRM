#!/bin/sh
set -e

# Run migrations
echo "Running migrations..."
php bin/console doctrine:migrations:migrate --no-interaction

# Create admin user if not exists
echo "Creating admin user..."
php bin/console app:create-user || true

# Start frankenphp
echo "Starting FrankenPHP..."
exec frankenphp run --config /etc/caddy/Caddyfile

