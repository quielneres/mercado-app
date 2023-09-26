<?php

// Carregue o autoloader do Composer
require __DIR__ . '/vendor/autoload.php';

use app\repositories\CustomMigrationRepository;
use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Migrations\MigrationRepositoryInterface;
use Illuminate\Database\Migrations\Migrator;

// Configuração do banco de dados (substitua pelas suas configurações)
$databaseConfig = [
    'driver' => 'pgsql',
    'host' => 'localhost',
    'database' => 'desafio',
    'username' => 'postgres',
    'password' => '45826160',
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => '',
];

// Inicialize o Capsule (Illuminate Database)
$capsule = new Capsule;
$capsule->addConnection($databaseConfig);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$container = new Container;
$container->instance(MigrationRepositoryInterface::class, new CustomMigrationRepository($capsule->getDatabaseManager()->getSchemaBuilder()->getConnectionResolver(), 'migrations'));

$migrator = new Migrator($container, $capsule->getDatabaseManager(), $container->make('files'), 'migrations');


// Execute as migrações pendentes
$migrator->runPending();

echo "Migrações concluídas." . PHP_EOL;