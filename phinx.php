<?php
require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Parse DSN from DB_HOST (e.g. mysql:host=localhost;dbname=unibooks_...)
$dsn = $_ENV['DB_HOST'];
preg_match('/host=([^;]+)/', $dsn, $host_matches);
preg_match('/dbname=([^;]+)/', $dsn, $db_matches);

$host = $host_matches[1] ?? 'localhost';
$name = $db_matches[1] ?? 'unibooks';
$user = $_ENV['DB_USER'];
$pass = $_ENV['DB_PASS'];

return
    [
        'paths' => [
            'migrations' => '%%PHINX_CONFIG_DIR%%/db/migrations',
            'seeds' => '%%PHINX_CONFIG_DIR%%/db/seeds'
        ],
        'environments' => [
            'default_migration_table' => 'phinxlog',
            'default_environment' => 'development',
            'development' => [
                'adapter' => 'mysql',
                'host' => $host,
                'name' => $name,
                'user' => $user,
                'pass' => $pass,
                'port' => '3306',
                'charset' => 'utf8',
            ],
            'production' => [
                'adapter' => 'mysql',
                'host' => $host,
                'name' => $name,
                'user' => $user,
                'pass' => $pass,
                'port' => '3306',
                'charset' => 'utf8',
            ]
        ],
        'version_order' => 'creation'
    ];
