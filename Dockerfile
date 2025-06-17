FROM php:7.4-apache

# Instalar extensões do PHP
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git curl \
    && docker-php-ext-install pdo pdo_mysql zip

# Ativar o mod_rewrite do Apache (necessário para Laravel)
RUN a2enmod rewrite

# Alterar o DocumentRoot do Apache para /var/www/html/public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

# Ajustar o arquivo de configuração do Apache com o novo DocumentRoot
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/000-default.conf

# Instalar Node.js
RUN curl -fsSL https://deb.nodesource.com/setup_16.x | bash - && \
    apt-get install -y nodejs

# Copiar o código para dentro do container
COPY . /var/www/html/

# Definir diretório de trabalho
WORKDIR /var/www/html

# Permissões para storage e cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instalar dependências do PHP
RUN composer install --no-dev --optimize-autoloader

# Instalar dependências do front-end e compilar assets (como www-data)
USER www-data
RUN npm install && npm run prod
USER root

# (Opcional) Se ainda houver problemas com npm, tente isto:
# RUN npm config set cache /tmp --global && \
#     npm install && \
#     npm run prod