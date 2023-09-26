<?php

namespace app\models;

use Illuminate\Database\Capsule\Manager as Capsule;

class Database {
    public function __construct()
    {
        try {
            $capsule = new Capsule;
            $capsule->addConnection([
                'driver' => DBDRIVER,
                'host' => DBHOST,
                'database' => DBNAME,
                'username' => DBUSER,
                'password' => DBPASS,
                'charset' => 'utf8',
                'collation' => 'utf8_unicode_ci',
                'prefix' => '',
            ]);

            $capsule->setAsGlobal();
            $capsule->bootEloquent();
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }
}