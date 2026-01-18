# ========================
# STAGE 1 – Composer
# ========================
FROM composer:2 AS composer

WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --prefer-dist --no-scripts

# ========================
# STAGE 2 – Node build
# ========================
FROM node:20 AS node

WORKDIR /app
COPY package.json package-lock.json ./
RUN npm install
COPY resources resources
COPY vite.config.js .
RUN npm run build

# ========================
# STAGE 3 – PHP Final
# ========================
FROM php:8.4-fpm

# Extensões necessárias
RUN docker-php-ext-install pdo pdo_mysql

WORKDIR /var/www

# Copia app
COPY . .

# Copia dependências
COPY --from=composer /app/vendor vendor
COPY --from=node /app/public/build public/build

# Permissões
RUN chown -R www-data:www-data storage bootstrap/cache

EXPOSE 9000
