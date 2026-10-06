#!/usr/bin/env bash
# ==============================================================================
# Script de Instalação e Provisionamento do Servidor VPS Contabo (Ubuntu 22.04/24.04)
# Projeto: RACHI - Ecossistema Integrado (Laravel 11 + Nginx + PHP 8.3 + MySQL + Node.js)
# ==============================================================================

set -e

# Cores
GREEN='\033[0;32m'
BLUE='\033[0;34m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
NC='\033[0m'

echo -e "${BLUE}===================================================================${NC}"
echo -e "${BLUE}   RACHI - INSTALACAO COMPLETA DO SERVIDOR VPS (CONTABO)          ${NC}"
echo -e "${BLUE}===================================================================${NC}\n"

# 1. Verificar root
if [ "$EUID" -ne 0 ]; then
  echo -e "${RED}[ERRO] Por favor, execute este script como root:${NC}"
  echo -e "       sudo bash scripts/setup-server-vps.sh\n"
  exit 1
fi

DOMAIN_OR_IP="${1:-13.140.189.10}"

echo -e "${BLUE}[1/8] Atualizando repositórios do sistema operacional...${NC}"
apt update -y && apt upgrade -y
apt install -y software-properties-common curl git unzip zip ufw ca-certificates lsb-release

echo -e "\n${BLUE}[2/8] Adicionando repositório PHP e instalando PHP 8.3 + Extensões...${NC}"
add-apt-repository -y ppa:ondrej/php
apt update -y
apt install -y php8.3-fpm php8.3-cli php8.3-mysql php8.3-sqlite3 php8.3-curl \
               php8.3-gd php8.3-mbstring php8.3-xml php8.3-zip php8.3-bcmath \
               php8.3-intl php8.3-soap php8.3-readline php8.3-msgpack php8.3-igbinary

echo -e "\n${BLUE}[3/8] Instalando Composer...${NC}"
if ! command -v composer &> /dev/null; then
  curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
fi

echo -e "\n${BLUE}[4/8] Instalando Node.js 20 LTS e NPM...${NC}"
if ! command -v node &> /dev/null; then
  curl -fsSL https://deb.nodesource.com/setup_20.x | bash -
  apt install -y nodejs
fi

echo -e "\n${BLUE}[5/8] Instalando Nginx e MySQL Server...${NC}"
apt install -y nginx mysql-server certbot python3-certbot-nginx
systemctl enable --now nginx
systemctl enable --now mysql

echo -e "\n${BLUE}[6/8] Configurando Nginx para o RACHI...${NC}"
cat > /etc/nginx/sites-available/rachi <<EOF
server {
    listen 80;
    listen [::]:80;
    server_name ${DOMAIN_OR_IP} _;
    root /var/www/rachi/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php index.html;
    charset utf-8;

    location / {
        try_files \$uri \$uri/ /index.php?\$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/run/php/php8.3-fpm.sock;
        fastcgi_param SCRIPT_FILENAME \$realpath_root\$fastcgi_script_name;
        include fastcgi_params;
        fastcgi_hide_header X-Powered-By;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
EOF

# Ativar virtual host
ln -sf /etc/nginx/sites-available/rachi /etc/nginx/sites-enabled/
rm -f /etc/nginx/sites-enabled/default
nginx -t && systemctl reload nginx

echo -e "\n${BLUE}[7/8] Configurando Firewall UFW...${NC}"
ufw allow OpenSSH
ufw allow 'Nginx Full'
ufw --force enable || true

echo -e "\n${BLUE}[8/8] Preparando diretório /var/www/rachi...${NC}"
mkdir -p /var/www/rachi
chown -R www-data:www-data /var/www/rachi

echo -e "\n${GREEN}===================================================================${NC}"
echo -e "${GREEN}   SERVIDOR PROVISIONADO COM SUCESSO!                              ${NC}"
echo -e "${GREEN}===================================================================${NC}"
echo -e "PHP          : $(php -v | head -n 1)"
echo -e "Composer     : $(composer --version | head -n 1)"
echo -e "Node.js      : $(node -v)"
echo -e "Nginx / MySQL: Ativos e configurados"
echo -e "Diretório Web: /var/www/rachi"
echo -e "-------------------------------------------------------------------"
echo -e "Próximos passos para subir a aplicação:"
echo -e " 1. Envie os arquivos do projeto para: /var/www/rachi"
echo -e " 2. Dentro de /var/www/rachi, execute:"
echo -e "    composer install --no-dev --optimize-autoloader"
echo -e "    npm install && npm run build"
echo -e "    sudo bash scripts/setup-production-db.sh"
echo -e "-------------------------------------------------------------------\n"
