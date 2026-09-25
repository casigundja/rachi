<?php

require __DIR__.'/../vendor/autoload.php';
$settings = Dotenv\Dotenv::parse(file_get_contents(__DIR__.'/../.env.supabase'));
try {
    $connection = new PDO(sprintf(
        'pgsql:host=%s;port=%s;dbname=%s;sslmode=require;connect_timeout=10',
        $settings['DB_HOST'], $settings['DB_PORT'], $settings['DB_DATABASE']
    ), $settings['DB_USERNAME'], $settings['DB_PASSWORD'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $result = $connection->query('SELECT (SELECT count(*) FROM users) AS users, (SELECT count(*) FROM courses) AS courses, (SELECT ssl FROM pg_stat_ssl WHERE pid = pg_backend_pid()) AS ssl')->fetch(PDO::FETCH_ASSOC);
    echo json_encode($result, JSON_PRETTY_PRINT).PHP_EOL;
} catch (PDOException $exception) {
    fwrite(STDERR, 'PostgreSQL connection failed (SQLSTATE '.$exception->getCode().'). Check connectivity and credentials.'.PHP_EOL);
    exit(1);
}
