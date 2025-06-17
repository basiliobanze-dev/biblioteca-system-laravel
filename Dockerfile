FROM php:7.4-apache

# Instalar extensões do PHP
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip \
    && docker-php-ext-install pdo pdo_mysql zip

# Ativar o mod_rewrite do Apache (necessário para Laravel)
RUN a2enmod rewrite

# Copiar o código para dentro do container
COPY . /var/www/html/

# Definir diretório correto para o Laravel (caso esteja em subpasta, ajuste aqui)
WORKDIR /var/www/html

# Permissões para storage e cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Instalar dependências PHP (composer precisa já estar no projeto ou usar bind mount)
# Alternativamente, instale composer aqui:
RUN curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer

RUN composer install --no-dev --optimize-autoloader
