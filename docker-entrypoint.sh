#!/bin/sh
set -e

# Create database file if it doesn't exist (touching it to ensure permissions)
mkdir -p var
touch var/data.db
chmod 777 var/data.db
chmod 777 var

echo "Updating database schema..."
# Schema update works fine with SQLite
php bin/console doctrine:schema:update --force --complete --no-interaction

# Create admin user if not exists
echo "Creating admin user..."
php bin/console app:create-user || true

# Start frankenphp
echo "Starting FrankenPHP..."
exec frankenphp run --config /etc/caddy/Caddyfile
