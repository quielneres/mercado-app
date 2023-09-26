<?php

use app\Migration\Migration;

require 'config.php';
return [
    'paths' => [
        'migrations' => 'database/migrations'
    ],
    'migration_base_class' => Migration::class,
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_database' => 'dev',
        'dev' => [
            'adapter' => DBDRIVER,
            'host' => DBHOST,
            'name' => DBNAME,
            'user' => DBUSER,
            'pass' => DBPASS
        ]
    ]
];