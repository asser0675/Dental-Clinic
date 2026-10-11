$ErrorActionPreference = "Stop"
Set-Location $PSScriptRoot

Write-Host "Cerillo Dental Clinic - Laravel Cache Path Repair" -ForegroundColor Cyan

$directories = @(
    ".\storage\framework\views",
    ".\storage\framework\cache",
    ".\storage\framework\cache\data",
    ".\storage\framework\sessions",
    ".\storage\framework\testing",
    ".\storage\logs",
    ".\bootstrap\cache"
)

foreach ($directory in $directories) {
    if (-not (Test-Path $directory)) {
        New-Item -ItemType Directory -Path $directory -Force | Out-Null
        Write-Host "Created $directory" -ForegroundColor Green
    } else {
        Write-Host "OK      $directory" -ForegroundColor DarkGreen
    }
}

if (Test-Path ".\artisan") {
    php artisan optimize:clear
    if ($LASTEXITCODE -ne 0) {
        throw "Laravel cache clear failed. Review the PHP/Laravel error printed above."
    }
}

Write-Host "`nCache path repair completed. You can now run: php artisan serve" -ForegroundColor Green
