#!/usr/bin/env bash
# ==============================================================================
# Script de Atualização / Deploy Contínuo
# Projeto: RACHI
# ==============================================================================

set -e

cd /var/www/rachi

echo "🚀 Iniciando Deploy do RACHI..."

# Ativar modo de manutenção temporário
php artisan down --render="errors::503" || true

# Atualizar dependências PHP
composer install --no-dev --optimize-autoloader --no-interaction

# Compilar Assets do Frontend
npm install --silent
npm run build

# Executar Migrações
php artisan migrate --force

# Limpar e recriar Caches
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Ajustar permissões
chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

# Desativar modo de manutenção
php artisan up

echo "✅ Deploy concluído com sucesso!"
