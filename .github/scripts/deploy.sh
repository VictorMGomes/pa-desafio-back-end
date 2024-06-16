#!/bin/bash

# Define the application path from GitHub Secrets
APP_PATH=${APP_PATH}

# Navigate to the application path
cd $APP_PATH

#Copy production .ENV file
cp $PRODUCTION_ENV $APP_PATH

# Pull the latest changes from the repository
git pull origin main

# Install/update Composer dependencies
composer install --no-interaction --prefer-dist --optimize-autoloader

# Run database migrations
php artisan migrate --force

# Clear and cache the configuration
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Set correct permissions (adjust as necessary)
chown -R www-data:www-data $APP_PATH
chmod -R 775 $APP_PATH/storage
chmod -R 775 $APP_PATH/bootstrap/cache

# Restart the server or queue workers if necessary
# sudo systemctl restart apache2
# sudo systemctl restart php-fpm
