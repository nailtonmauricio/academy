# ------------------------------------------------------------
# JITTE Academy — imagem de produção (Laravel + Nginx + PHP-FPM)
# Mesmo padrão do JITTE Gestão.
# ------------------------------------------------------------

# Etapa 1: compila os assets do front (Vite)
# Se o projeto não usa Vite/npm, apague esta etapa e a linha
# "COPY --from=assets" lá embaixo.
FROM node:20-alpine AS assets
WORKDIR /app
COPY package*.json ./
RUN npm ci
COPY . .
RUN npm run build

# Etapa 2: aplicação PHP
# Ajuste a versão do PHP para a que o projeto usa (8.2, 8.3, 8.4)
FROM serversideup/php:8.3-fpm-nginx

# Extensões PHP extras que o projeto precisar (ex.: intl, gd, bcmath)
USER root
RUN install-php-extensions intl gd bcmath
USER www-data

ENV PHP_OPCACHE_ENABLE=1

WORKDIR /var/www/html

# Dependências do Composer primeiro (aproveita cache entre deploys)
COPY --chown=www-data:www-data composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist --no-interaction

# Código da aplicação
COPY --chown=www-data:www-data . .

# Assets compilados na etapa 1
COPY --from=assets --chown=www-data:www-data /app/public/build ./public/build

RUN composer dump-autoload --optimize --no-dev

# A imagem serve a aplicação na porta 8080
EXPOSE 8080