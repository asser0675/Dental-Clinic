CERILLO DENTAL V6 — NORMAL ARTISAN STARTUP

1. Extract into a NEW directory. Keep a backup of your existing .env and database.
2. If you already have a working .env connected to the existing MySQL database,
   keep that original file; do NOT replace it with the starter .env in this ZIP.
   Verify DB_CONNECTION=mysql, CACHE_STORE=file, SESSION_DRIVER=file.
3. For a new installation, edit the included .env MySQL username and password
   to match your running MySQL server (default assumes root with no password).
4. Run exactly: php artisan config:clear
5. Start normally: php artisan serve

No custom launcher or vendor edits are required.

Root corrections in this archive:
- .env included, with MySQL + file cache/session instead of default SQLite.
- PHP_CLI_SERVER_WORKERS=1 for Windows.
- public/index.php starts output buffering before handling requests to prevent
  accidental early output causing the secondary Symfony 'headers already sent'
  fatal error. The original PHP error may still need independent investigation.

DO NOT RUN migrate:fresh or delete your database.
This build has been checked for PHP syntax where possible. A real Windows/MySQL
end-to-end request test is not possible from the build environment.
