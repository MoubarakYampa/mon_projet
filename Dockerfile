# Utiliser une image PHP avec serveur Apache
FROM php:8.2-apache

# Copier le fichier index.php dans le dossier par défaut d'Apache
COPY index.php /var/www/html/

# Expose le port 80
EXPOSE 80

