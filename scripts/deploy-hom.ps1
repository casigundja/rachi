# ==============================================================================
# Script de Deploy para Homologação - RACHI
# Executa a sincronização do projeto Windows -> Servidor Contabo (169.58.137.10)
# ==============================================================================

Write-Host "🚀 Iniciando Deploy para Homologação (https://hom.rachi.ao)..." -ForegroundColor Cyan

$server = "root@169.58.137.10"
$key = "$HOME\.ssh\id_ed25519"
$archive = Join-Path $env:TEMP "rachi_deploy_hom.tar.gz"
$projectRoot = (Resolve-Path "$PSScriptRoot\..").Path

Write-Host "📦 Compactando arquivos do projeto..." -ForegroundColor Yellow
tar --exclude="node_modules" --exclude="vendor" --exclude=".git" --exclude="scratch" --exclude=".wrangler" --exclude=".env" --exclude=".env.*" -czf "$archive" -C "$projectRoot" .

Write-Host "📤 Enviando pacote para o servidor VPS..." -ForegroundColor Yellow
scp -i "$key" -o BatchMode=yes "$archive" "${server}:/tmp/rachi_deploy_hom.tar.gz"

Write-Host "⚙️ Aplicando atualizações no ambiente de homologação..." -ForegroundColor Yellow
ssh -n -i "$key" $server @"
cd /opt/rachi/hom
tar -xzf /tmp/rachi_deploy_hom.tar.gz -C /opt/rachi/hom/
npm install --silent
npm run build
docker exec rachi-hom-php composer install --no-dev --optimize-autoloader --no-interaction
docker exec rachi-hom-php php artisan migrate --force
docker exec rachi-hom-php php artisan optimize:clear
docker exec rachi-hom-php php artisan config:cache
docker exec rachi-hom-php php artisan route:cache
docker exec rachi-hom-php php artisan view:cache
docker exec rachi-hom-php chown -R www-data:www-data storage bootstrap/cache
docker exec rachi-hom-php chmod -R 775 storage bootstrap/cache
rm -f /tmp/rachi_deploy_hom.tar.gz
"@

Remove-Item -Path "$archive" -Force -ErrorAction SilentlyContinue

Write-Host "✅ Deploy concluído com sucesso em https://hom.rachi.ao !" -ForegroundColor Green
