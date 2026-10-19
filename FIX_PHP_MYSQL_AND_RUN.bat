@echo off
cd /d "%~dp0"
echo Fixing PHP 8.3 MySQL driver...
powershell -NoProfile -ExecutionPolicy Bypass -File "%~dp0FIX_PHP_MYSQL.ps1"
if errorlevel 1 (
  echo.
  echo Fix did not complete. Read the message above.
  pause
  exit /b 1
)
echo.
echo Starting Patient CRUD at http://127.0.0.1:8000
C:\php83\php.exe artisan serve
pause
