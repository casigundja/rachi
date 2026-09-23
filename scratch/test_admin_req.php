<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$requests = app(App\Http\Controllers\Admin\AdminRequestController::class)->allRequests();
echo "Controller returned: " . count($requests) . " requests\n";
foreach ($requests as $r) {
    echo "ID: {$r['id']} | Protocol: {$r['protocol']} | Cliente: {$r['cliente']} | Unidade: {$r['servico']} | Status: {$r['status']} | Messages: " . count($r['messages']) . "\n";
    foreach ($r['messages'] as $m) {
        echo "   - {$m['nome']} (is_staff: " . ($m['is_staff'] ? 'true' : 'false') . "): {$m['message']}\n";
    }
}
