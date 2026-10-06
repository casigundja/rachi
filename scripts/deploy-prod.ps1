# ==============================================================================
# Script de Deploy para Producao - RACHI
# Executa o streaming direto Windows -> Servidor Contabo (169.58.137.10)
# ==============================================================================

Write-Host "Iniciando Deploy para Producao (https://rachi.ao)..." -ForegroundColor Cyan

$server = "root@169.58.137.10"
$key = "$HOME\.ssh\id_ed25519"
$projectRoot = (Resolve-Path "$PSScriptRoot\..").Path

Push-Location "$projectRoot"
try {
    Write-Host "Criando pacote de deploy..." -ForegroundColor DarkGray
    tar.exe -czf deploy-pack.tar.gz --exclude="deploy-pack.tar.gz" --exclude="node_modules" --exclude="vendor" --exclude=".git" --exclude="scratch" --exclude=".wrangler" --exclude=".env" --exclude=".env.*" .
    Write-Host "Enviando pacote para a VPS via SCP..." -ForegroundColor DarkGray
    scp -i "$key" deploy-pack.tar.gz "${server}:/opt/rachi/prod/deploy-pack.tar.gz"
    Write-Host "Extraindo arquivos no servidor..." -ForegroundColor DarkGray
    ssh -i "$key" $server "tar -xzf /opt/rachi/prod/deploy-pack.tar.gz -C /opt/rachi/prod && rm -f /opt/rachi/prod/deploy-pack.tar.gz"
}
finally {
    if (Test-Path "$projectRoot\deploy-pack.tar.gz") {
        Remove-Item "$projectRoot\deploy-pack.tar.gz" -Force
    }
    Pop-Location
}

Write-Host "Aplicando atualizacoes no ambiente de producao..." -ForegroundColor Yellow
$remoteCommands = "cd /opt/rachi/prod && npm install --silent && npm run build && docker exec rachi-prod-php composer install --no-dev --optimize-autoloader --no-interaction && docker exec rachi-prod-php php artisan migrate --force && docker exec rachi-prod-php php artisan optimize:clear && docker exec rachi-prod-php php artisan config:cache && docker exec rachi-prod-php php artisan route:cache && docker exec rachi-prod-php php artisan view:cache && docker exec rachi-prod-php chown -R www-data:www-data storage bootstrap/cache && docker exec rachi-prod-php chmod -R 775 storage bootstrap/cache"
ssh -n -i "$key" $server $remoteCommands

Write-Host "Deploy concluido com sucesso em https://rachi.ao !" -ForegroundColor Green
