#!/usr/bin/env bash

cd /app

mkdir -p storage/framework/cache/data storage/framework/sessions storage/framework/views storage/logs bootstrap/cache
chmod -R 775 storage bootstrap/cache 2>/dev/null || true

echo "==> Waiting for database (max 60s)..."
for i in $(seq 1 30); do
    if php artisan migrate:status --no-interaction >/dev/null 2>&1; then
        echo "==> Database ready."
        php artisan migrate --force --no-interaction
        php artisan db:seed --force --no-interaction
        php artisan storage:link --force --no-interaction 2>/dev/null || true
        break
    fi
    if [ "$i" -eq 30 ]; then
        echo "==> Database not ready — check DB_URL in Railway Variables."
    fi
    sleep 2
done

PORT="${PORT:-8080}"
echo "==> Starting server on 0.0.0.0:${PORT}..."
exec php artisan serve --host=0.0.0.0 --port="${PORT}"
