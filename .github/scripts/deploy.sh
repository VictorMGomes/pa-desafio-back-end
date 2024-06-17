#!/bin/bash

cd "$APP_PATH"

git pull origin main

composer install --no-dev --no-progress --prefer-dist

if [ -n "$PRODUCTION_ENV" ]; then
  cp "$PRODUCTION_ENV" .env
fi

php artisan migrate --force

php artisan config:cache
php artisan route:cache
php artisan view:cache
