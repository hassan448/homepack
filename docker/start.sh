#!/usr/bin/env bash

cd /app

mkdir -p storage/framework/cache/data storage/framework/sessions storage/framework/views storage/logs bootstrap/cache
chmod -R 775 storage bootstrap/cache 2>/dev/null || true

setup_database() {
    echo "==> [setup] Waiting for database..."
    for i in $(seq 1 45); do
        if php artisan migrate:status --no-interaction >/dev/null 2>&1; then
            echo "==> [setup] Database ready."
            php artisan migrate --force --no-interaction
            php artisan db:seed --force --no-interaction
            php artisan storage:link --force --no-interaction 2>/dev/null || true
            echo "==> [setup] Done."
            return 0
        fi
        sleep 2
    done
    echo "==> [setup] Database unavailable — verify DB_CONNECTION=pgsql and DB_URL=\${{Postgres.DATABASE_URL}}"
    return 1
}

setup_database &

PORT="${PORT:-8080}"
echo "==> Starting server on 0.0.0.0:${PORT}..."
exec php artisan serve --host=0.0.0.0 --port="${PORT}"
