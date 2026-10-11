@echo off
setlocal
cd /d "%~dp0"
if not exist "artisan" (
 echo ERROR: Run this from the Laravel project root. 
 pause
 exit /b 1
)
if not exist ".env" (
 if not exist ".env.example" (
  echo Missing .env and .env.example
  pause
  exit /b 1
 )
 copy /y ".env.example" ".env" >nul
 echo Created .env from MySQL starter settings.
 echo IMPORTANT: Review database credentials before using patient data.
)
set "PHP_CLI_SERVER_WORKERS=1"
php -v >nul 2>&1 || (echo ERROR: PHP is not installed or not on PATH & pause & exit /b 1)
php artisan config:clear || (echo ERROR: Failed to clear configuration & pause & exit /b 1)
php artisan view:clear
php artisan cache:clear
php artisan key:generate --show >nul 2>&1
if errorlevel 1 echo Warning: Check APP_KEY in .env.
echo.
echo Starting Cerillo Dental Clinic at http://127.0.0.1:8000
php artisan serve --host=127.0.0.1 --port=8000
pause
