FROM php:7.4-apache

# Instalar extensões do PHP
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git curl \
    && docker-php-ext-install pdo pdo_mysql zip

# Ativar o mod_rewrite do Apache (necessário para Laravel)
RUN a2enmod rewrite

# Alterar o DocumentRoot do Apache para /var/www/html/public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/000-default.conf

# Instalar Node.js (v16)
RUN curl -fsSL https://deb.nodesource.com/setup_16.x | bash - && \
    apt-get install -y nodejs

# Criar diretório para cache do npm e ajustar permissões
RUN mkdir -p /var/www/.npm && chown -R www-data:www-data /var/www/.npm

# Copiar o código para dentro do container
COPY . /var/www/html/

# Definir diretório de trabalho
WORKDIR /var/www/html

# Ajustar permissões para diretórios Laravel
RUN chown -R www-data:www-data storage bootstrap/cache

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instalar dependências PHP como root
RUN composer install --no-dev --optimize-autoloader

# 🔐 Rodar npm install como www-data com cache corrigido
USER www-data
RUN npm install && npm run prod
USER root