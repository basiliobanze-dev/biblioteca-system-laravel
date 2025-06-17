FROM php:7.4-apache

# Instalar extensões PHP
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git curl \
    && docker-php-ext-install pdo pdo_mysql zip

# Ativar mod_rewrite (Laravel precisa)
RUN a2enmod rewrite

# Configurar Apache para servir public/
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/000-default.conf

# Instalar Node.js + npm (para compilar CSS/JS)
RUN curl -fsSL https://deb.nodesource.com/setup_16.x | bash - && \
    apt-get install -y nodejs

# Copiar código Laravel
COPY . /var/www/html/
WORKDIR /var/www/html

# Corrigir permissões
RUN chown -R www-data:www-data storage bootstrap/cache

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer

# Instalar dependências PHP
RUN composer install --no-dev --optimize-autoloader

# Instalar dependências do front-end e compilar assets
RUN npm install && npm run prod
