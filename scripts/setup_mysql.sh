#!/bin/bash
# Setup MySQL untuk project Bliss in Bali
echo "==> Membuat database blissinbali..."
mysql -e "CREATE DATABASE IF NOT EXISTS blissinbali CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

echo "==> Mengubah auth method root ke mysql_native_password (tanpa password)..."
mysql -e "ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY ''; FLUSH PRIVILEGES;"

echo "==> Verifikasi..."
mysql -u root -e "SHOW DATABASES LIKE 'blissinbali';"

echo "==> Selesai! Sekarang coba php artisan migrate"
