@echo off
title School Management System - ATTAR AYOUB
color 0A

echo.
echo =====================================================
echo    SCHOOL MANAGEMENT SYSTEM  -  ATTAR AYOUB
echo =====================================================
echo.
echo  STEP 1: Make sure XAMPP is open and BOTH
echo          Apache AND MySQL are STARTED (green).
echo.
echo  STEP 2: This window will start the Laravel server.
echo          Do NOT close this window while using the app.
echo.
echo =====================================================
pause

cd /d "%~dp0"

echo.
echo [*] Clearing caches...
php artisan config:clear
php artisan cache:clear
php artisan view:clear

echo.
echo [*] Running migrations...
php artisan migrate --force

echo.
echo [*] Seeding database...
php artisan db:seed --force

echo.
echo =====================================================
echo   App is running at:  http://127.0.0.1:8000
echo.
echo   LOGIN CREDENTIALS:
echo   --------------------------------------------------
echo   Admin:   admin@school.com        / admin123
echo   Teacher: fatima.zahra@school.com / teacher123
echo   Teacher: youssef.alami@school.com / teacher123
echo =====================================================
echo.
echo   Open your browser and go to: http://127.0.0.1:8000
echo   Press CTRL+C to stop the server.
echo.

php artisan serve

pause
