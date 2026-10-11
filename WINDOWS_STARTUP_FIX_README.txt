DENTALCERILLO V6 - WINDOWS STARTUP FIX

1. Keep your existing .env file and MySQL database. Do not copy a new .env over yours.
2. If you have PHP_CLI_SERVER_WORKERS=4 in your existing .env, change it to 1.
3. Prefer CACHE_STORE=file and SESSION_DRIVER=file on local installations (this avoids DB cache/session setup issues).
4. Double-click START_CERILLO_WINDOWS.cmd.
5. If an HTTP error persists, inspect storage/logs/laravel.log for the first exception. The Symfony header trace may be a SECONDARY error, and this configuration patch cannot establish all other causes.

No database, migrations, or patient records are modified by this patch.
