#!/bin/sh
set -e

# Run migrations (with retry loop)
echo "Waiting for database to be ready..."
until php bin/console dbal:run-sql "SELECT 1" > /dev/null 2>&1; do
  echo "Database is not ready, sleeping..."
  sleep 2
done

echo "Updating database schema..."
# Using schema:update instead of migrations because migration history seems broken (missing table creation)
php bin/console doctrine:schema:update --force --complete --no-interaction

# Create admin user if not exists
echo "Creating admin user..."
php bin/console app:create-user || true

# Start frankenphp
echo "Starting FrankenPHP..."
exec frankenphp run --config /etc/caddy/Caddyfile
