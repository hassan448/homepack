#!/usr/bin/env bash
set -e

cd /app

echo "==> Waiting for database..."
for i in {1..60}; do
    if php artisan migrate:status --no-interaction >/dev/null 2>&1; then
        echo "==> Database ready."
        break
    fi
    if [ "$i" -eq 60 ]; then
        echo "==> Warning: database not ready after 120s, continuing anyway..."
    fi
    sleep 2
done

echo "==> Running migrations..."
php artisan migrate --force --no-interaction

echo "==> Seeding database..."
php artisan db:seed --force --no-interaction

echo "==> Linking storage..."
php artisan storage:link --force --no-interaction || true

echo "==> Optimizing..."
php artisan config:cache --no-interaction
php artisan route:cache --no-interaction
php artisan view:cache --no-interaction
php artisan optimize --no-interaction

echo "==> Starting server on port ${PORT:-10000}..."
exec php artisan serve --host=0.0.0.0 --port="${PORT:-10000}"
