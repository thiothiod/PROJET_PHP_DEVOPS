# Utiliser l'image officielle PHP avec Apache
FROM php:8.2-apache

# Activer le module Apache 'rewrite' pour permettre les URL propres
RUN a2enmod rewrite

# Installer les extensions PHP nécessaires pour MySQL
# mysqli : connexion MySQL via mysqli
# pdo et pdo_mysql : connexion MySQL via PDO (recommandé pour Laravel ou PDO)
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copier tous les fichiers du projet local dans le dossier par défaut d'Apache dans le container
COPY . /var/www/html/

# Changer le propriétaire des fichiers pour l'utilisateur Apache 'www-data'
# Cela évite les problèmes de permission lors de l'exécution du serveur web
RUN chown -R www-data:www-data /var/www/html