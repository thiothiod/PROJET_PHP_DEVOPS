FROM php:8.3-apache

# Installer dépendances PostgreSQL pour compiler les extensions PHP
RUN apt-get update && apt-get install -y \
    libpq-dev \
    postgresql-client \
    && docker-php-ext-install pdo pdo_pgsql pgsql

# Copier le script wait-for-db.sh
COPY wait-for-db.sh /usr/local/bin/wait-for-db.sh
RUN chmod +x /usr/local/bin/wait-for-db.sh