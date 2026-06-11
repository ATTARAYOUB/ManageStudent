@echo off
title School Management System
color 0A

echo.
echo =====================================================
echo    SCHOOL MANAGEMENT SYSTEM  -  ATTAR AYOUB
echo =====================================================
echo.
echo [1] Make sure XAMPP Apache + MySQL are running!
echo [2] Starting Laravel server...
echo.

cd /d "%~dp0"

echo [*] Running migrations...
php artisan migrate --force

echo.
echo [*] Seeding database (safe - uses updateOrCreate)...
php artisan db:seed --force

echo.
echo =====================================================
echo   Server: http://127.0.0.1:8000
echo.
echo   Admin:   admin@school.com    / admin123
echo   Teacher: fatima.zahra@school.com / teacher123
echo   Teacher: youssef.alami@school.com / teacher123
echo =====================================================
echo.

php artisan serve

pause
