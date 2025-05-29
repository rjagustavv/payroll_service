# Gunakan image PHP resmi, versi dengan Apache (web server)
FROM php:8.4-apache

# Install ekstensi PHP tambahan jika diperlukan
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Salin file aplikasi ke dalam direktori root Apache di dalam container
COPY . /var/www/html/

# Aktifkan modul Apache jika diperlukan (misal: rewrite)
RUN a2enmod rewrite

# Set permission folder (opsional, tergantung kebutuhan)
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Expose port 80 (default Apache)
EXPOSE 80
