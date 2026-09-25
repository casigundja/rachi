# Banco RACHI no Supabase

Projeto: `qgnuifxfocixodcfoqsz` (RACHI), região `sa-east-1`.

Painel: https://supabase.com/dashboard/project/qgnuifxfocixodcfoqsz

Foi importada uma cópia consistente de `database/database.sqlite`: 31 tabelas
e 319 registros, incluindo 17 registros do histórico de migrações. As contagens
de todas as tabelas foram verificadas no destino após a importação.

O esquema foi compilado pelas migrações Laravel para PostgreSQL. A restrição
CHECK antiga de `course_enrollments.status` foi removida para refletir a mudança
local para texto livre. IDs, relacionamentos e dados foram preservados, e as
sequências foram ajustadas para permitir novas inserções.

As tabelas têm RLS habilitado e não concedem acesso a `anon` ou `authenticated`.
O sistema continua usando sua autenticação Laravel; usuários não foram migrados
para o serviço Supabase Auth.

## Arquivos locais

- `.env.supabase`: credenciais do novo banco, ignoradas pelo Git.
- `storage/app/supabase-transfer/20260925-024952/backup.sqlite`: snapshot de origem.
- Na mesma pasta: `import.sql`, `verify.sql` e `manifest.json`.
- `bin/export-supabase.php`: gerador de exportação; não envia dados por conta própria.

Os arquivos de transferência contêm dados privados e estão ignorados pelo Git.
O SQL de importação destina-se a um banco vazio e falha se as tabelas já existirem.

## Conexão do aplicativo

O `.env` ativo continua usando SQLite. A transferência foi uma cópia pontual;
alterações posteriores no SQLite não são sincronizadas automaticamente.

Antes de trocar a aplicação para PostgreSQL, habilitar `pdo_pgsql` no PHP
(ausente no ambiente consultado), configurar SSL na conexão Laravel, testar a
conectividade e validar os fluxos do aplicativo. A conexão direta salva utiliza
o host do projeto; ambientes sem IPv6 podem precisar do pooler do Supabase.
