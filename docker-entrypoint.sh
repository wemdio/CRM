#!/bin/sh
set -e

# Print minimal env diagnostics (avoid secrets)
echo "APP_ENV=${APP_ENV:-}"
echo "APP_DEBUG=${APP_DEBUG:-}"
echo "PORT=${PORT:-}"
echo "SERVER_NAME=${SERVER_NAME:-}"

# If an old debug front controller is present (from previous experiments or cached images),
# replace it with the standard Symfony Runtime front controller.
if [ -f public/index.php ] && grep -q "SYSTEM CHECK: PHP IS WORKING" public/index.php; then
  echo "Detected debug public/index.php; restoring Symfony front controller..."
  cat > public/index.php <<'PHP'
<?php

use App\Kernel;

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

return function (array $context) {
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};
PHP
fi

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
