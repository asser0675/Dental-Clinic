$ErrorActionPreference = "Stop"
Set-Location $PSScriptRoot

function Step([string]$message) {
    Write-Host "`n==> $message" -ForegroundColor Cyan
}

function Run-Checked([string]$program, [string[]]$arguments) {
    Write-Host ("    > {0} {1}" -f $program, ($arguments -join ' ')) -ForegroundColor DarkGray
    & $program @arguments
    $code = $LASTEXITCODE
    if ($code -ne 0) {
        throw "COMMAND FAILED: $program $($arguments -join ' ') (exit code $code). The actual error is printed immediately ABOVE this line."
    }
}

function Run-Output([string]$program, [string[]]$arguments) {
    $output = & $program @arguments 2>&1
    $code = $LASTEXITCODE
    return [PSCustomObject]@{ Output = @($output); ExitCode = $code }
}

Write-Host "Cerillo Dental Clinic V4.1 - Windows Setup (Revised)" -ForegroundColor Green
Write-Host "Project: $PSScriptRoot"

Step "Checking Laravel project files"
$requiredFiles = @(
    ".\artisan",
    ".\composer.json",
    ".\composer.lock",
    ".\bootstrap\app.php",
    ".\bootstrap\providers.php",
    ".\routes\web.php"
)
foreach ($file in $requiredFiles) {
    if (-not (Test-Path $file)) {
        throw "Required project file is missing: $file. Re-extract this ZIP into a NEW short folder such as C:\CerilloV41."
    }
}
Write-Host "Required Laravel files are present." -ForegroundColor Green

Step "Checking PHP executable"
$phpCommand = Get-Command php -ErrorAction SilentlyContinue
if (-not $phpCommand) {
    throw "PHP is not in PATH. Open the terminal/environment where the 'php' command works, then run this script again."
}
$phpPath = $phpCommand.Source
Write-Host "PHP executable: $phpPath"

# First prove php.exe itself works WITHOUT php.ini. This separates binary problems from php.ini problems.
$barePhp = Run-Output $phpPath @("-n", "-r", "echo PHP_VERSION;")
if ($barePhp.ExitCode -ne 0) {
    $barePhp.Output | ForEach-Object { Write-Host $_ -ForegroundColor Red }
    throw "php.exe itself cannot start even with php.ini disabled. Repair/reinstall this PHP build or fix its PATH/runtime DLL dependencies."
}
Write-Host ("PHP binary version: " + (($barePhp.Output -join "").Trim())) -ForegroundColor Green

Step "Checking active php.ini and PHP runtime"
& $phpPath --ini

$normalPhp = Run-Output $phpPath @("-r", "echo 'PHP_RUNTIME_OK';")
if ($normalPhp.ExitCode -ne 0 -or (($normalPhp.Output -join "`n") -notmatch "PHP_RUNTIME_OK")) {
    Write-Host "`nPHP works without php.ini, but fails with your active php.ini." -ForegroundColor Red
    Write-Host "This means the PHP INSTALLATION/CONFIGURATION is the issue, not the Cerillo project." -ForegroundColor Yellow
    Write-Host "The exact PHP startup error is below:" -ForegroundColor Yellow
    $normalPhp.Output | ForEach-Object { Write-Host $_ -ForegroundColor Red }
    Write-Host "`nRun these manually and fix the extension named in the warning:" -ForegroundColor Yellow
    Write-Host "    php --ini"
    Write-Host "    php -m"
    throw "Active php.ini is preventing PHP from starting correctly."
}
Write-Host "PHP starts correctly with the active php.ini." -ForegroundColor Green

Step "Checking required PHP extensions"
$modulesResult = Run-Output $phpPath @("-m")
if ($modulesResult.ExitCode -ne 0) {
    $modulesResult.Output | ForEach-Object { Write-Host $_ -ForegroundColor Red }
    throw "PHP could not list extensions. Fix the PHP startup warning shown above."
}
$modules = $modulesResult.Output | ForEach-Object { $_.ToString().Trim().ToLowerInvariant() }
$requiredExtensions = @("fileinfo", "openssl", "mbstring", "pdo", "pdo_mysql")
$missing = @()
foreach ($ext in $requiredExtensions) {
    if ($modules -notcontains $ext) { $missing += $ext }
}
if ($missing.Count -gt 0) {
    Write-Host ("Missing/disabled PHP extensions: " + ($missing -join ", ")) -ForegroundColor Red
    Write-Host "Open the php.ini displayed above and enable the matching extension= lines." -ForegroundColor Yellow
    Write-Host "Common Windows lines are:" -ForegroundColor Yellow
    Write-Host "    extension=fileinfo"
    Write-Host "    extension=mbstring"
    Write-Host "    extension=openssl"
    Write-Host "    extension=pdo_mysql"
    throw "Required PHP extensions are missing."
}
Write-Host "Required PHP extensions are enabled." -ForegroundColor Green

Step "Checking Composer"
$composerCommand = Get-Command composer -ErrorAction SilentlyContinue
if (-not $composerCommand) {
    throw "Composer is not in PATH. Install/enable Composer first."
}
Run-Checked "composer" @("--version")

Step "Preparing .env"
if (-not (Test-Path ".\.env")) {
    if (-not (Test-Path ".\.env.example")) {
        throw ".env.example is missing. Re-extract the ZIP."
    }
    Copy-Item ".\.env.example" ".\.env"
    Write-Host "Created .env from .env.example." -ForegroundColor Yellow
} else {
    Write-Host ".env already exists; keeping your current database settings." -ForegroundColor Green
}

Step "Preparing Laravel runtime directories"
$runtimeDirectories = @(
    ".\storage\framework\views",
    ".\storage\framework\cache",
    ".\storage\framework\cache\data",
    ".\storage\framework\sessions",
    ".\storage\framework\testing",
    ".\storage\logs",
    ".\bootstrap\cache"
)
foreach ($directory in $runtimeDirectories) {
    if (-not (Test-Path $directory)) {
        New-Item -ItemType Directory -Path $directory -Force | Out-Null
    }
}
Write-Host "Laravel cache/session/view directories are ready." -ForegroundColor Green

Step "Installing Composer dependencies"
# Do not delete a valid vendor folder on every retry. If it is incomplete, Composer repairs it.
Run-Checked "composer" @("install", "--prefer-dist", "--no-interaction")

Step "Checking Laravel bootstrap"
Run-Checked $phpPath @("artisan", "--version")

$envText = Get-Content ".\.env" -Raw
if ($envText -match '(?m)^APP_KEY=\s*$') {
    Step "Generating application key"
    Run-Checked $phpPath @("artisan", "key:generate")
}

Step "Clearing cached configuration"
Run-Checked $phpPath @("artisan", "config:clear")

Step "Checking database connection before migrations"
Write-Host "The project will use DB_HOST / DB_PORT / DB_DATABASE / DB_USERNAME / DB_PASSWORD from .env." -ForegroundColor Yellow
Write-Host "Make sure MySQL/XAMPP is running and the database in .env exists." -ForegroundColor Yellow

Step "Running database migrations"
Run-Checked $phpPath @("artisan", "migrate", "--force")

Step "Seeding initial clinic data"
Run-Checked $phpPath @("artisan", "db:seed", "--force")

Step "Clearing Laravel caches"
Run-Checked $phpPath @("artisan", "optimize:clear")

Write-Host "`nSETUP COMPLETED SUCCESSFULLY." -ForegroundColor Green
Write-Host "Start the system with:" -ForegroundColor Green
Write-Host "    php artisan serve"
Write-Host "Then open: http://127.0.0.1:8000"
