# Usa a imagem oficial do PHP 7.4 com FPM (FastCGI Process Manager)
FROM php:7.4-fpm

# Instala dependências do sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Instala Node.js 16.x (versão compatível com Laravel 6)
RUN curl -fsSL https://deb.nodesource.com/setup_16.x | bash - \
    && apt-get install -y nodejs

# Instala o Composer (versão 2.2, mesma do seu ambiente local)
COPY --from=composer:2.2 /usr/bin/composer /usr/bin/composer

# Configura o diretório de trabalho
WORKDIR /app

# Copia os arquivos do projeto para o container
COPY . .

# Instala dependências do PHP (ignorando conflitos de versão)
RUN composer install --ignore-platform-reqs --no-interaction --prefer-dist --optimize-autoloader

# Instala dependências do Node.js e executa o build (se necessário)
RUN npm install && npm run build

# Configura permissões para o Laravel
RUN chown -R www-data:www-data /app/storage \
    && chmod -R 775 /app/storage

# Comando para iniciar o servidor (Railway usa a variável $PORT)
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=$PORT"]