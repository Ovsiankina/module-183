# Documentation de l'exa blanc

## Mise en route

```bash

if [[ ! -f database/database.sqlite ]]; then

    echo "Update composer"
    composer update
    echo "Install with composer"
    composer install
    echo "Init of dot env"
    cp .env.example .env

    echo "Creating SQLite database file..."
    touch database/database.sqlite
    echo "Running initial migrations..."
    php artisan migrate --force
    echo "Seeding database..."
    php artisan db:seed --force
else

php artisan serve --host=127.0.0.1 --port=8000
```
