<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SyncCloudDatabase extends Command
{
    protected $signature = 'db:sync-cloud';

    protected $description = 'Sincroniza o banco de dados local com o PostgreSQL de Produção (Cloudflare/Supabase)';

    protected string $projectRef = 'qgnuifxfocixodcfoqsz';

    public function handle(): int
    {
        $this->info("=== Sincronizando com PostgreSQL de Produção ({$this->projectRef}) ===");

        $query = <<<'SQL'
SELECT json_build_object(
  'roles', (SELECT coalesce(json_agg(t), '[]'::json) FROM (SELECT * FROM public.roles) t),
  'permissions', (SELECT coalesce(json_agg(t), '[]'::json) FROM (SELECT * FROM public.permissions) t),
  'role_permissions', (SELECT coalesce(json_agg(t), '[]'::json) FROM (SELECT * FROM public.role_permissions) t),
  'business_units', (SELECT coalesce(json_agg(t), '[]'::json) FROM (SELECT * FROM public.business_units) t),
  'categories', (SELECT coalesce(json_agg(t), '[]'::json) FROM (SELECT * FROM public.categories) t),
  'users', (SELECT coalesce(json_agg(t), '[]'::json) FROM (SELECT * FROM public.users) t),
  'customers', (SELECT coalesce(json_agg(t), '[]'::json) FROM (SELECT * FROM public.customers) t),
  'employees', (SELECT coalesce(json_agg(t), '[]'::json) FROM (SELECT * FROM public.employees) t),
  'addresses', (SELECT coalesce(json_agg(t), '[]'::json) FROM (SELECT * FROM public.addresses) t),
  'services', (SELECT coalesce(json_agg(t), '[]'::json) FROM (SELECT * FROM public.services) t),
  'products', (SELECT coalesce(json_agg(t), '[]'::json) FROM (SELECT * FROM public.products) t),
  'product_images', (SELECT coalesce(json_agg(t), '[]'::json) FROM (SELECT * FROM public.product_images) t),
  'stock_movements', (SELECT coalesce(json_agg(t), '[]'::json) FROM (SELECT * FROM public.stock_movements) t),
  'service_requests', (SELECT coalesce(json_agg(t), '[]'::json) FROM (SELECT * FROM public.service_requests) t),
  'service_request_status_histories', (SELECT coalesce(json_agg(t), '[]'::json) FROM (SELECT * FROM public.service_request_status_histories) t),
  'quotes', (SELECT coalesce(json_agg(t), '[]'::json) FROM (SELECT * FROM public.quotes) t),
  'quote_items', (SELECT coalesce(json_agg(t), '[]'::json) FROM (SELECT * FROM public.quote_items) t),
  'orders', (SELECT coalesce(json_agg(t), '[]'::json) FROM (SELECT * FROM public.orders) t),
  'order_items', (SELECT coalesce(json_agg(t), '[]'::json) FROM (SELECT * FROM public.order_items) t),
  'payments', (SELECT coalesce(json_agg(t), '[]'::json) FROM (SELECT * FROM public.payments) t),
  'courses', (SELECT coalesce(json_agg(t), '[]'::json) FROM (SELECT * FROM public.courses) t),
  'course_modules', (SELECT coalesce(json_agg(t), '[]'::json) FROM (SELECT * FROM public.course_modules) t),
  'course_lessons', (SELECT coalesce(json_agg(t), '[]'::json) FROM (SELECT * FROM public.course_lessons) t),
  'course_enrollments', (SELECT coalesce(json_agg(t), '[]'::json) FROM (SELECT * FROM public.course_enrollments) t),
  'course_progress', (SELECT coalesce(json_agg(t), '[]'::json) FROM (SELECT * FROM public.course_progress) t),
  'files', (SELECT coalesce(json_agg(t), '[]'::json) FROM (SELECT * FROM public.files) t),
  'messages', (SELECT coalesce(json_agg(t), '[]'::json) FROM (SELECT * FROM public.messages) t),
  'reviews', (SELECT coalesce(json_agg(t), '[]'::json) FROM (SELECT * FROM public.reviews) t),
  'activity_logs', (SELECT coalesce(json_agg(t), '[]'::json) FROM (SELECT * FROM public.activity_logs) t),
  'notifications', (SELECT coalesce(json_agg(t), '[]'::json) FROM (SELECT * FROM public.notifications) t),
  'worker_contacts', (SELECT coalesce(json_agg(t), '[]'::json) FROM (SELECT * FROM public.worker_contacts) t),
  'worker_attachments', (SELECT coalesce(json_agg(t), '[]'::json) FROM (SELECT id, service_request_id, user_id, name, mime_type, encode(content, 'base64') as content, created_at FROM public.worker_attachments) t),
  'worker_rate_limits', (SELECT coalesce(json_agg(t), '[]'::json) FROM (SELECT * FROM public.worker_rate_limits) t),
  'worker_sessions', (SELECT coalesce(json_agg(t), '[]'::json) FROM (SELECT * FROM public.worker_sessions) t)
) as dump;
SQL;

        $tempSqlFile = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'dump_sync_temp.sql';
        file_put_contents($tempSqlFile, $query);

        $this->output->write("A descarregar dados da nuvem via Supabase CLI... ");
        $cmd = "npx supabase db query --linked --project-ref {$this->projectRef} -f " . escapeshellarg($tempSqlFile);
        
        $output = shell_exec($cmd);
        @unlink($tempSqlFile);

        if (!$output || !preg_match('/\{[\s\S]*\}/', $output, $matches)) {
            $this->error("\nFalha ao obter resposta JSON da nuvem.");
            return self::FAILURE;
        }

        $decoded = json_decode($matches[0], true);
        if (!$decoded || !isset($decoded['rows'][0]['dump'])) {
            $this->error("\nEstrutura JSON inválida recebida da nuvem.");
            return self::FAILURE;
        }

        $dump = $decoded['rows'][0]['dump'];
        $this->info("OK! (" . count($dump) . " tabelas encontradas)");

        // Desativar foreign keys durante importação
        if (DB::getDriverName() === 'sqlite') {
            DB::statement('PRAGMA foreign_keys = OFF;');
        }

        $syncedCounts = [];

        foreach ($dump as $tableName => $rows) {
            if (!Schema::hasTable($tableName)) {
                continue;
            }

            $tableColumns = Schema::getColumnListing($tableName);
            DB::table($tableName)->truncate();

            if (!empty($rows)) {
                $batch = [];
                foreach ($rows as $row) {
                    $item = [];
                    foreach ($row as $col => $val) {
                        if (in_array($col, $tableColumns)) {
                            if (is_array($val)) {
                                $val = json_encode($val);
                            } elseif (is_bool($val)) {
                                $val = $val ? 1 : 0;
                            }
                            $item[$col] = $val;
                        }
                    }
                    $batch[] = $item;
                }

                foreach (array_chunk($batch, 100) as $chunk) {
                    DB::table($tableName)->insert($chunk);
                }
            }

            $syncedCounts[$tableName] = count($rows);
        }

        if (DB::getDriverName() === 'sqlite') {
            DB::statement('PRAGMA foreign_keys = ON;');
        }

        $this->newLine();
        $this->table(
            ['Tabela', 'Registos Sincronizados'],
            collect($syncedCounts)->map(fn($cnt, $tbl) => [$tbl, $cnt])->toArray()
        );

        $this->info("✓ Sincronização concluída com sucesso! Banco local está idêntico à Produção.");
        return self::SUCCESS;
    }
}
