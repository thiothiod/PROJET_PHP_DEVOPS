# TODO Steps for PHP MySQL App Fix

## Completed
- [x] Create .env with DB credentials
- [x] Update index.php with env-aware DB connection and fixes
- [x] Verify and finalize file changes

## Remaining
1. Run `docker compose up -d --build` to start services (web on :8000, phpmyadmin :8080).
2. Test app: Visit http://localhost:8000, submit form, check users list.
3. Verify DB: http://localhost:8080 (login root/root, db test_db).
4. Local Laragon test (optional): Create 'test_db' in phpMyAdmin, run `php -S localhost:8000`.

## Commands
```bash
# Docker (recommended)
docker compose up -d --build

# View logs
docker compose logs -f web db

# Local (Laragon)
php -S localhost:8000
```

