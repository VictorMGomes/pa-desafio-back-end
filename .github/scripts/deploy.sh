#!/bin/bash

if [ -z "$APP_PATH" ]; then
  echo "APP_PATH não está definido"
  exit 1
fi

cd "$APP_PATH" || { echo "Falha ao mudar para o diretório $APP_PATH"; exit 1; }

git pull origin main

composer install --no-dev --no-progress --prefer-dist

if [ -n "$PRODUCTION_ENV" ]; then
  cp "$PRODUCTION_ENV" .env
fi

php artisan migrate --force

php artisan config:cache
php artisan route:cache
php artisan view:cache
