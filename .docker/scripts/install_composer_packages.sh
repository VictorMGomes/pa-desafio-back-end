#!/bin/bash
set -e

# Check if Docker is running
if ! command -v docker &> /dev/null
then
    echo "Docker is not installed or not running."
    exit 1
fi

# Set Docker context to 'default'
docker context use default

# Log file path and name
LOG_FILE="$(pwd)/.docker/logs/composer_script.log"

# Ensure log directory exists
mkdir -p "$(dirname "$LOG_FILE")"

# Function to execute Docker command and log output
execute_and_log() {
    echo "Running command: $@"
    echo "--------------------" >> "$LOG_FILE"
    echo "Command: $@" >> "$LOG_FILE"
    echo "--------------------" >> "$LOG_FILE"
    "$@" >> "$LOG_FILE" 2>&1
    echo "" >> "$LOG_FILE"
}

# Run composer install inside the Laravel Sail container and remove it after install
execute_and_log docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php83-composer:latest \
    composer install

# Remove the Laravel Sail Docker image
execute_and_log docker rmi laravelsail/php83-composer:latest

# Optionally, add more commands here that should stop script on error

# End of script
