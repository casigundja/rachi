<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\ServiceRequest;
use App\Models\Message;

echo "Total ServiceRequests: " . ServiceRequest::count() . "\n";
foreach (ServiceRequest::with(['messages', 'statusHistories'])->get() as $sr) {
    echo "#{$sr->id} | {$sr->protocol} | {$sr->title} | Status: {$sr->status} | Messages: " . $sr->messages->count() . " | Histories: " . $sr->statusHistories->count() . "\n";
    foreach ($sr->messages as $m) {
        echo "   - Msg #{$m->id} [User {$m->user_id}]: {$m->message}\n";
    }
}
