#!/bin/sh
set -e

# Ensure writable directories for Symfony + SQLite (Timeweb filesystem can be restrictive)
mkdir -p var public/build
chmod -R 777 var public/build || true

# Create SQLite database file if it doesn't exist
touch var/data.db || true
chmod 777 var/data.db || true

echo "Updating database schema..."
# Schema update works fine with SQLite
php bin/console doctrine:schema:update --force --complete --no-interaction || true

# Create admin user if not exists
echo "Creating admin user..."
php bin/console app:create-user || true

# Warm cache (non-fatal)
php bin/console cache:clear --no-interaction || true

# Start frankenphp
echo "Starting FrankenPHP..."
exec frankenphp run --config /etc/caddy/Caddyfile
