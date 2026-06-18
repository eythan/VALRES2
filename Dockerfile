FROM php:8.2-apache

# Extensions PHP nécessaires (PDO MySQL)
RUN docker-php-ext-install pdo pdo_mysql

# Active mod_rewrite (utile si besoin de réécriture d'URL)
RUN a2enmod rewrite

# DocumentRoot sur le dossier public/
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Copie du code de l'application
COPY . /var/www/html/

# Droits pour Apache
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80