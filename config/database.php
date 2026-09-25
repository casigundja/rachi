<?php

$config = require base_path('vendor/laravel/framework/config/database.php');
$config['connections']['pgsql']['sslmode'] = env('DB_SSLMODE', 'require');

return $config;
