@echo off
REM ═══════════════════════════════════════════════════════════════
REM   School Management System - Start Script
REM   Author: ATTAR AYOUB
REM ═══════════════════════════════════════════════════════════════

echo.
echo ╔═══════════════════════════════════════════════════════════════╗
echo ║                                                               ║
echo ║         School Management System - Starting...               ║
echo ║                                                               ║
echo ╚═══════════════════════════════════════════════════════════════╝
echo.

REM Check if XAMPP is running
echo [*] Checking XAMPP services...
tasklist | find /i "apache" >nul
if errorlevel 1 (
    echo [!] Apache is not running. Starting XAMPP...
    start "" "C:\xampp\xampp-control.exe"
    timeout /t 5 /nobreak
) else (
    echo [✓] Apache is already running
)

tasklist | find /i "mysql" >nul
if errorlevel 1 (
    echo [!] MySQL is not running. Please start it from XAMPP Control Panel.
) else (
    echo [✓] MySQL is already running
)

echo.
echo [*] Navigating to project directory...
cd /d "C:\xampp\htdocs\StudentManagement-ATTAR AYOUB\ManageStudent"

echo [*] Installing/updating dependencies...
composer install --no-interaction

echo.
echo [*] Running migrations...
php artisan migrate --force

echo.
echo [*] Starting Laravel development server...
echo.
echo ╔═══════════════════════════════════════════════════════════════╗
echo ║                                                               ║
echo ║  ✓ Server is running at: http://127.0.0.1:8000              ║
echo ║                                                               ║
echo ║  Default Login Credentials:                                  ║
echo ║  - Email: admin@example.com                                  ║
echo ║  - Password: password                                        ║
echo ║                                                               ║
echo ║  Press Ctrl+C to stop the server                             ║
echo ║                                                               ║
echo ╚═══════════════════════════════════════════════════════════════╝
echo.

php artisan serve

pause
