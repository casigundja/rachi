# Cloudflare + Supabase

Estado: **não publicado**. A conta Cloudflare autenticada recusou Containers
por não possuir Workers Paid. É necessário ativar o plano em:
https://dash.cloudflare.com/e8c87d3bd3a989eb8dcd12bfd52e97a6/workers/plans

## Preparação realizada

- `Dockerfile`: Apache/PHP 8.3, extensões PostgreSQL e build Vite.
- `.dockerignore`: inclui apenas código e recursos; exclui credenciais, SQLite,
  backups, sessões locais, `public/hot` e dependências locais.
- `wrangler.jsonc` e `deploy/worker.js`: Worker `rachi`, um container, secrets
  encaminhados por variáveis de ambiente.
- `config/database.php`: SSL configurável, obrigatório por padrão em PostgreSQL.
- Migração de sessões persistentes no banco, ainda não executada.

## Verificações

- `npm run build`: passou.
- Sintaxe PHP dos arquivos de configuração/migração: passou.
- `npx wrangler deploy --dry-run --outdir storage/app/deploy/worker --containers-rollout=none`: passou.
- `php -d extension=pdo_pgsql deploy/check-database.php`: conexão Supabase
  confirmada com SSL; 14 usuários e 14 cursos.
- `docker build -t rachi-cloudflare:local .`: bloqueado por DNS no download das
  imagens base. Imagem ainda não construída nem testada via HTTP.

## Antes da publicação

1. Ativar Workers Paid e concluir a construção/teste da imagem Docker.
2. Definir `APP_URL`, `DB_HOST`, `DB_USERNAME` e salvar `APP_KEY`/`DB_PASSWORD`
   como secrets do Worker. Não incluir `.env` ou `.env.supabase` na imagem.
3. Aplicar a migração de sessões no Supabase, usando a configuração remota.
4. Configurar armazenamento persistente para anexos: o disco local do container
   é efêmero. Atualmente `FileService` grava no disco `public` local.
5. Corrigir as rotas existentes de gestão `/admin/users` e `/admin/academy`
   que estão sem middleware de autenticação/autorização, e o acesso público
   às conversas em `/solicitacoes/conversas`. A página `/academy/login` também
   envia a lista de matrículas ao navegador. Essas rotas precisam de revisão
   antes de expor os dados do Supabase na internet.
6. Publicar, aguardar provisionamento e testar páginas, login, permissões,
   sessões e gravações no endereço HTTPS final.

O `.env` local permanece usando SQLite. Nenhum secret foi enviado ao Cloudflare
e nenhuma migração de deploy foi aplicada ao Supabase nesta preparação.
