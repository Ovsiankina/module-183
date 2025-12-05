# File name: startup.sh
# Author: ovsiankina
# Date created: 2025-12-05 09:59:43
# Date modified: 2025-12-05 14:49:08
# ----------------------------------
# Copyright (c) 2025 Ovsiankina <ovsiankina@proton.me>
#
# All rights reserved.

echo "Update composer"
composer update
# if [[ ! -f database/database.sqlite ]]; then
echo "Install with composer"
composer install
echo "Init of dot env"
cp .env.example .env

echo "Generating key"
php artisan key:generate
echo "Creating SQLite database file..."
touch database/database.sqlite
echo "Running initial migrations..."
php artisan migrate --force
echo "Seeding database..."
php artisan db:seed --force
# fi
php artisan serve --host=127.0.0.1 --port=8000
