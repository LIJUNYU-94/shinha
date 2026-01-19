FROM php:8.2

# 1. System dependencies & PHP extensions
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    curl \
    gnupg \
    && docker-php-ext-install pdo_mysql zip gd bcmath

# 2. Install Node.js (Required for Vite/Tailwind build)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# 3. Get Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# 4. Copy application files
COPY . .

# 5. Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# 6. Install Node dependencies & Build Assets (Vite)
RUN npm install && npm run build

# 7. Permissions (Write access for storage)
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# 8. Create storage link
RUN php artisan storage:link

# 9. Server configuration
ENV PORT=8080
EXPOSE 8080

# Use the PORT environment variable provided by Railway
CMD php artisan serve --host=0.0.0.0 --port=${PORT}