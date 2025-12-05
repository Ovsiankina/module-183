# Repository Guidelines

## Project Structure & Module Organization
- Laravel 11 app: core domain logic in `app/`, HTTP controllers/middleware in `app/Http`, models and factories in `app/Models` and `database/factories`.
- Routes live in `routes/web.php` (browser) and `routes/api.php` (API). Blade views and Vite entry points sit in `resources/`, with public assets served from `public/`.
- Database migrations and seeders are under `database/migrations` and `database/seeders`; the default SQLite file is `database/database.sqlite`.
- Tests are split into `tests/Feature` and `tests/Unit`. Temporary and cached data belong in `storage/`.

## Build, Test, and Development Commands
- `composer install` then `npm install`: install PHP and JS dependencies.
- `php artisan migrate --seed`: apply migrations and seed baseline data to `database/database.sqlite`.
- `php artisan serve --host=127.0.0.1 --port=8000`: run the backend locally.
- `npm run dev` (or `npm run build` for production): run/build frontend assets via Vite.
- `php artisan test` or `./vendor/bin/phpunit`: execute the test suite; add `--filter` to target a class or method.

## Coding Style & Naming Conventions
- Follow PSR-12; `.editorconfig` enforces LF endings, UTF-8, 4-space indentation (YAML uses 2). Trim trailing whitespace; end files with a newline.
- PHP classes use StudlyCaps (`UserController`), methods camelCase, constants SCREAMING_SNAKE_CASE. Blade view filenames use kebab-case; Vite entry files live in `resources/js` and `resources/css`.
- Prefer Laravel helpers (e.g., `route()`, `request()`) and dependency injection in controllers/services.

## Testing Guidelines
- Place feature tests under `tests/Feature` and unit-level logic under `tests/Unit`; suffix classes with `Test`.
- Seed or factory-create data inside tests; avoid coupling to existing database state.
- Aim to cover new branches and error paths; use `php artisan test --coverage` locally when feasible.

## Commit & Pull Request Guidelines
- Use short, imperative commit messages (e.g., `Add ticket creation flow`); group related changes per commit when possible.
- Pull requests should include: clear summary, linked issue/requirement, migration/seed notes, and screenshots or steps to verify UI changes.
- Keep diffs minimal: avoid unrelated formatting changes; run tests (`php artisan test`) and, when touching front-end assets, `npm run build` before requesting review.

## Environment & Security Notes
- Duplicate `.env.example` to `.env` and update secrets; never commit `.env` or `database/database.sqlite`.
- Regenerate keys with `php artisan key:generate` when creating a fresh environment.
- Validate and sanitize request data in form requests or controllers; prefer Laravel authorization policies for access checks.
