<?php

$sqliteFile = __DIR__ . '/../database/database.sqlite';
$outputFile = __DIR__ . '/../database/d1-schema.sql';

if (!file_exists($sqliteFile)) {
    die("database.sqlite not found!\n");
}

$pdo = new PDO('sqlite:' . $sqliteFile);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sqlDump = "-- Cloudflare D1 Schema & Seed Data for rachi-db\n";
$sqlDump .= "-- Generated: " . date('Y-m-d H:i:s') . "\n\n";
$sqlDump .= "PRAGMA foreign_keys = OFF;\n\n";

// 1. Get Tables
$tables = $pdo->query("SELECT name, sql FROM sqlite_master WHERE type='table' AND name NOT LIKE 'sqlite_%' AND name NOT LIKE '_cf_%' ORDER BY name")->fetchAll(PDO::FETCH_ASSOC);

foreach ($tables as $t) {
    $name = $t['name'];
    $createSql = $t['sql'];
    $sqlDump .= "DROP TABLE IF EXISTS `{$name}`;\n";
    $sqlDump .= "{$createSql};\n\n";
}

// 2. Insert Data
foreach ($tables as $t) {
    $name = $t['name'];
    $rows = $pdo->query("SELECT * FROM `{$name}`")->fetchAll(PDO::FETCH_ASSOC);
    if (empty($rows)) continue;

    $sqlDump .= "-- Data for `{$name}`\n";
    foreach ($rows as $row) {
        $cols = array_keys($row);
        $escapedCols = array_map(fn($c) => "`{$c}`", $cols);
        $escapedVals = array_map(function($v) use ($pdo) {
            if ($v === null) return 'NULL';
            return $pdo->quote($v);
        }, array_values($row));

        $sqlDump .= "INSERT INTO `{$name}` (" . implode(', ', $escapedCols) . ") VALUES (" . implode(', ', $escapedVals) . ");\n";
    }
    $sqlDump .= "\n";
}

// 3. Get Indexes
$indexes = $pdo->query("SELECT sql FROM sqlite_master WHERE type='index' AND sql IS NOT NULL AND name NOT LIKE 'sqlite_%'")->fetchAll(PDO::FETCH_COLUMN);
foreach ($indexes as $idx) {
    $sqlDump .= "{$idx};\n";
}

file_put_contents($outputFile, $sqlDump);
echo "Dump concluído: {$outputFile} (" . strlen($sqlDump) . " bytes)\n";
