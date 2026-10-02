#!/usr/bin/env bash
# ==============================================================================
# Script de Configuração Automatizada do Banco de Dados MySQL na Produção (Contabo)
# Projeto: RACHI - Ecossistema Integrado
# ==============================================================================

set -e

# Cores para feedback visual
GREEN='\033[0;32m'
BLUE='\033[0;34m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
NC='\033[0m' # No Color

echo -e "${BLUE}===================================================================${NC}"
echo -e "${BLUE}   RACHI - CONFIGURACAO AUTOMATIZADA DO BANCO DE DADOS (MYSQL)     ${NC}"
echo -e "${BLUE}===================================================================${NC}\n"

# 1. Verificar permissões de root/sudo
if [ "$EUID" -ne 0 ]; then
  echo -e "${RED}[ERRO] Por favor, execute este script como root ou com sudo:${NC}"
  echo -e "       sudo bash scripts/setup-production-db.sh\n"
  exit 1
fi

# 2. Definir parâmetros da Base de Dados
DB_NAME="${DB_NAME:-rachi_db}"
DB_USER="${DB_USER:-rachi_user}"
DB_HOST="${DB_HOST:-127.0.0.1}"
DB_PORT="${DB_PORT:-3306}"

# Gerar senha forte se não foi informada
if [ -z "$DB_PASSWORD" ]; then
  DB_PASSWORD=$(openssl rand -base64 16 | tr -dc 'a-zA-Z0-9' | head -c 16)
  echo -e "${YELLOW}[INFO] Nenhuma senha foi informada. Gerada automaticamente uma senha segura.${NC}"
fi

# 3. Detectar diretório do projeto
PROJECT_DIR="$(pwd)"
if [ ! -f "$PROJECT_DIR/artisan" ]; then
  if [ -f "/var/www/rachi/artisan" ]; then
    PROJECT_DIR="/var/www/rachi"
  else
    echo -e "${RED}[ERRO] O arquivo 'artisan' do Laravel não foi encontrado no diretório atual nem em /var/www/rachi.${NC}"
    echo -e "       Execute o script a partir da pasta raiz do projeto RACHI.\n"
    exit 1
  fi
fi

echo -e "${BLUE}[1/7] Verificando instalação do MySQL / MariaDB...${NC}"
if ! command -v mysql &> /dev/null; then
  echo -e "${YELLOW}MySQL não encontrado. Instalando MySQL Server e extensões PHP...${NC}"
  apt update -y
  apt install -y mysql-server php-mysql
fi

# Garantir que o serviço MySQL está ativo
systemctl enable --now mysql || systemctl enable --now mariadb

echo -e "${GREEN}✓ Servidor MySQL está ativo e pronto.${NC}\n"

echo -e "${BLUE}[2/7] Criando Base de Dados e Utilizador no MySQL...${NC}"
mysql -e "CREATE DATABASE IF NOT EXISTS \`${DB_NAME}\` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
mysql -e "CREATE USER IF NOT EXISTS '${DB_USER}'@'localhost' IDENTIFIED BY '${DB_PASSWORD}';"
mysql -e "ALTER USER '${DB_USER}'@'localhost' IDENTIFIED BY '${DB_PASSWORD}';"
mysql -e "GRANT ALL PRIVILEGES ON \`${DB_NAME}\`.* TO '${DB_USER}'@'localhost';"
mysql -e "FLUSH PRIVILEGES;"

echo -e "${GREEN}✓ Base de dados '${DB_NAME}' e utilizador '${DB_USER}' configurados com sucesso.${NC}\n"

echo -e "${BLUE}[3/7] Configurando o arquivo .env do Laravel...${NC}"
cd "$PROJECT_DIR"

if [ ! -f ".env" ]; then
  if [ -f ".env.example" ]; then
    cp .env.example .env
    echo -e "${YELLOW}Criado .env a partir de .env.example.${NC}"
  else
    touch .env
  fi
fi

# Atualizar ou adicionar variáveis de banco no .env
set_env_var() {
  local key=$1
  local value=$2
  if grep -q "^${key}=" .env; then
    sed -i "s|^${key}=.*|${key}=${value}|" .env
  elif grep -q "^#\s*${key}=" .env; then
    sed -i "s|^#\s*${key}=.*|${key}=${value}|" .env
  else
    echo "${key}=${value}" >> .env
  fi
}

set_env_var "DB_CONNECTION" "mysql"
set_env_var "DB_HOST" "$DB_HOST"
set_env_var "DB_PORT" "$DB_PORT"
set_env_var "DB_DATABASE" "$DB_NAME"
set_env_var "DB_USERNAME" "$DB_USER"
set_env_var "DB_PASSWORD" "$DB_PASSWORD"

# Garantir APP_KEY
if ! grep -q "^APP_KEY=base64:" .env; then
  echo -e "${YELLOW}Gerando nova APP_KEY...${NC}"
  php artisan key:generate --force
fi

echo -e "${GREEN}✓ Arquivo .env atualizado com as credenciais do MySQL.${NC}\n"

echo -e "${BLUE}[4/7] Limpando caches anteriores do Laravel...${NC}"
php artisan optimize:clear || true

echo -e "\n${BLUE}[5/7] Executando Migrações (criando as 19 tabelas)...${NC}"
php artisan migrate --force

echo -e "\n${BLUE}[6/7] Executando Seeders (carregando dados iniciais oficiais)...${NC}"
php artisan db:seed --force

echo -e "\n${BLUE}[7/7] Ajustando links de storage, permissões e caches de produção...${NC}"
php artisan storage:link || true

# Otimizar caches
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Permissões das pastas do servidor web
if id "www-data" &>/dev/null; then
  chown -R www-data:www-data "$PROJECT_DIR/storage" "$PROJECT_DIR/bootstrap/cache"
  chmod -R 775 "$PROJECT_DIR/storage" "$PROJECT_DIR/bootstrap/cache"
fi

echo -e "\n${GREEN}===================================================================${NC}"
echo -e "${GREEN}   CONFIGURACAO CONCLUIDA COM SUCESSO!                             ${NC}"
echo -e "${GREEN}===================================================================${NC}"
echo -e "Base de Dados : ${YELLOW}${DB_NAME}${NC}"
echo -e "Utilizador    : ${YELLOW}${DB_USER}${NC}"
echo -e "Host / Porta  : ${YELLOW}${DB_HOST}:${DB_PORT}${NC}"
echo -e "Senha         : ${YELLOW}${DB_PASSWORD}${NC}"
echo -e "-------------------------------------------------------------------"
echo -e "Todas as tabelas foram criadas e alimentadas com os dados oficiais."
echo -e "Guarde as credenciais acima em local seguro!\n"
