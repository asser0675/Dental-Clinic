CERILLO DENTAL CLINIC V4.1 - CLEAN WINDOWS PACKAGE
===================================================

WHY THIS PACKAGE EXISTS
-----------------------
The previous ZIP contained the Composer vendor directory. Windows Explorer could
hit Error 0x80010135 (Path too long) while copying/extracting deeply nested
vendor files. An interrupted extraction can leave required Laravel files such as
bootstrap/app.php missing.

THIS PACKAGE FIXES THAT BY:
---------------------------
1. Keeping bootstrap/app.php and all Cerillo application source files.
2. Removing vendor from the ZIP. Composer will create vendor correctly on your PC.
3. Removing generated Laravel caches/logs.
4. Keeping the V4.1 pagination/contact/patient-ID/responsive changes.
5. Providing SETUP_CERILLO_WINDOWS.ps1 for a clean dependency + migration setup.

IMPORTANT
---------
DO NOT copy files from your old broken DentalClinicUpdateV4.1 folder into this one.
Start from this ZIP only.

RECOMMENDED LOCATION
--------------------
Extract to a short path, for example:
    C:\CerilloV41

ONE-COMMAND SETUP
-----------------
1. Make sure MySQL/XAMPP is running and the database configured in .env exists.
2. Open PowerShell in the extracted project folder.
3. Run:

    powershell -ExecutionPolicy Bypass -File .\SETUP_CERILLO_WINDOWS.ps1

4. If setup completes, start the site:

    php artisan serve

5. Open:

    http://127.0.0.1:8000

MANUAL SETUP COMMANDS
---------------------
If you prefer to do it manually:

    php -m | findstr fileinfo
    composer install
    php artisan --version
    php artisan config:clear
    php artisan migrate
    php artisan optimize:clear
    php artisan serve

DO NOT RUN composer update just to install this project. Use composer install so
composer.lock remains authoritative.
