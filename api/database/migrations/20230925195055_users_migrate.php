<?php

declare(strict_types=1);

use app\Migration\Migration;
use Illuminate\Database\Capsule\Manager as Capsule;

final class UsersMigrate extends Migration
{
    public function up()
    {
        Capsule::schema()->create('users', function ($table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->timestamps();

        });
    }

    public function down()
    {
        Capsule::schema()->drop('users');
    }
}
