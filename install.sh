#!/bin/bash

# Check if Laravel is already installed
if [ -d "vendor" ]; then
    echo "Laravel is already installed."
    exit 1
fi

# Run composer install
composer install

php artisan breeze:install --pest --dark --typescript blade

# Run migrations
php artisan migrate:fresh --seed

# Generate Key
php artisan key:generate

# Link the storage
php artisan storage:link

# Install npm dependencies
npm install

# Build the Frontend
npm run build
