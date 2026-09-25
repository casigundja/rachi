<?php

// Generates an atomic PostgreSQL import from a consistent SQLite snapshot.
// Does not connect to or modify the remote database.
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

require __DIR__.'/../vendor/autoload.php';
$app = require __DIR__.'/../bootstrap/app.php';
$app->make(Kernel::class)->bootstrap();
$directory = storage_path('app/supabase-transfer/'.gmdate('Ymd-His'));
if (!mkdir($directory, 0700, true)) {
    throw new RuntimeException('Cannot create export directory.');
}
$source = new SQLite3(database_path('database.sqlite'), SQLITE3_OPEN_READONLY);
$snapshot = new SQLite3($directory.'/backup.sqlite');
if (!$source->backup($snapshot)) {
    throw new RuntimeException('SQLite backup failed.');
}
$source->close();
$snapshot->close();
$sqlite = new PDO('sqlite:'.$directory.'/backup.sqlite');
$sqlite->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if ($sqlite->query('PRAGMA integrity_check')->fetchColumn() !== 'ok' || $sqlite->query('PRAGMA foreign_key_check')->fetch()) {
    throw new RuntimeException('Source integrity check failed.');
}
$quoteIdentifier = static fn ($value) => '"'.str_replace('"', '""', $value).'"';
$quoteValue = static function ($value): string {
    if ($value === null) return 'NULL';
    if (str_contains((string) $value, "\0")) throw new RuntimeException('NUL byte cannot be imported as PostgreSQL text.');
    return "'".str_replace("'", "''", (string) $value)."'";
};
DB::setDefaultConnection('pgsql');
$queries = DB::connection()->pretend(function () {
    Schema::create('migrations', function (Blueprint $table) {
        $table->increments('id');
        $table->string('migration');
        $table->integer('batch');
    });
    foreach (glob(database_path('migrations/*.php')) as $path) {
        (require $path)->up();
    }
});
$sql = ["BEGIN;", "SET LOCAL search_path TO public;", "SET LOCAL standard_conforming_strings = on;"];
$tableOrder = [];
foreach ($queries as $query) {
    if ($query['bindings']) throw new RuntimeException('Unexpected schema bindings.');
    $sql[] = $query['query'].';';
    if (preg_match('/^create table "([^"]+)"/i', $query['query'], $match)) $tableOrder[] = $match[1];
}
// Laravel's enum -> string change retains the PostgreSQL enum CHECK unless explicitly removed.
$sql[] = 'ALTER TABLE "course_enrollments" DROP CONSTRAINT IF EXISTS "course_enrollments_status_check";';
$actualTables = $sqlite->query("SELECT name FROM sqlite_master WHERE type='table' AND name NOT LIKE 'sqlite_%'")->fetchAll(PDO::FETCH_COLUMN);
$left = array_diff($actualTables, $tableOrder);
$right = array_diff($tableOrder, $actualTables);
if ($left || $right) throw new RuntimeException('Schema/table mismatch: '.json_encode([$left, $right]));
$manifest = [];
$checks = [];
foreach ($tableOrder as $table) {
    $quotedTable = $quoteIdentifier($table);
    $columns = $sqlite->query('PRAGMA table_info('.$quotedTable.')')->fetchAll(PDO::FETCH_ASSOC);
    $rows = $sqlite->query('SELECT * FROM '.$quotedTable.' ORDER BY id')->fetchAll(PDO::FETCH_ASSOC);
    $sql[] = 'ALTER TABLE '.$quotedTable.' ENABLE ROW LEVEL SECURITY;';
    $sql[] = 'REVOKE ALL ON TABLE '.$quotedTable.' FROM anon, authenticated;';
    $booleans = array_column(array_filter($columns, static fn ($column) => strtolower($column['type']) === 'tinyint(1)' || strtolower($column['type']) === 'boolean'), 'name');
    foreach ($rows as $row) {
        $values = [];
        foreach ($row as $name => $value) {
            if ($value !== null && in_array($name, $booleans, true)) {
                if (!in_array((string) $value, ['0', '1'], true)) throw new RuntimeException('Invalid boolean: '.$table.'.'.$name);
                $values[] = $value ? 'TRUE' : 'FALSE';
            } else {
                $values[] = $quoteValue($value);
            }
        }
        $sql[] = 'INSERT INTO '.$quotedTable.' ('.implode(', ', array_map($quoteIdentifier, array_keys($row))).') VALUES ('.implode(', ', $values).');';
    }
    $id = array_values(array_filter($columns, static fn ($column) => $column['name'] === 'id'))[0] ?? null;
    if ($id && str_contains(strtolower($id['type']), 'int')) {
        $sql[] = "SELECT setval(pg_get_serial_sequence(".$quoteValue('public.'.$table).", 'id'), COALESCE((SELECT MAX(id) FROM ".$quotedTable."), 1), EXISTS(SELECT 1 FROM ".$quotedTable."));";
        $sql[] = 'REVOKE ALL ON SEQUENCE '.$quoteIdentifier($table.'_id_seq').' FROM anon, authenticated;';
    }
    $manifest[$table] = count($rows);
    $checks[] = 'SELECT '.$quoteValue($table).' AS table_name, count(*) AS row_count FROM public.'.$quotedTable;
    $sql[] = 'DO $verify$ BEGIN IF (SELECT count(*) FROM '.$quotedTable.') <> '.count($rows)." THEN RAISE EXCEPTION 'Row count mismatch for ".$table."'; END IF; END ".'$verify$;';
}
$sql[] = 'COMMIT;';
file_put_contents($directory.'/import.sql', implode("\n", $sql)."\n");
file_put_contents($directory.'/verify.sql', implode("\nUNION ALL\n", $checks)."\nORDER BY table_name;\n");
file_put_contents($directory.'/manifest.json', json_encode($manifest, JSON_PRETTY_PRINT)."\n");
echo json_encode(['directory' => $directory, 'tables' => count($manifest), 'rows' => array_sum($manifest), 'counts' => $manifest], JSON_PRETTY_PRINT).PHP_EOL;
