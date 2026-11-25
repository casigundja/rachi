# Script para Alternância de Ambiente Local: Homologação vs Produção
param (
    [Parameter(Mandatory=$true)]
    [ValidateSet('staging', 'homologacao', 'prod', 'production')]
    [string]$Ambiente
)

$target = $Ambiente.ToLower()
if ($target -eq 'staging' -or $target -eq 'homologacao') {
    Copy-Item -Path ".env.staging" -Destination ".env" -Force
    Write-Host "Ambiente alterado para: HOMOLOGACAO / STAGING" -ForegroundColor Yellow
    Write-Host "Base de dados local: database/database_staging.sqlite" -ForegroundColor Cyan
    Write-Host "Cloudflare Worker: https://rachi-staging.casimirogundja.workers.dev" -ForegroundColor Cyan
    Write-Host "Para subir alteracoes de homologacao: npm run deploy:staging" -ForegroundColor Green
} else {
    Copy-Item -Path ".env.production" -Destination ".env" -Force
    Write-Host "Ambiente alterado para: PRODUCAO" -ForegroundColor Green
    Write-Host "URL Oficial: https://rachi.ao" -ForegroundColor Cyan
    Write-Host "Para subir alteracoes de producao: npm run deploy:prod" -ForegroundColor Yellow
}
