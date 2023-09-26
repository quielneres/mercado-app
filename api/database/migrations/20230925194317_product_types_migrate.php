<?php

declare(strict_types=1);

use app\Migration\Migration;
use Illuminate\Database\Capsule\Manager as Capsule;

final class ProductTypesMigrate extends Migration
{
    public function up()
    {
        Capsule::schema()->create('product_types', function ($table) {
            $table->increments('id');
            $table->string('description');
            $table-> double('tax_percentage', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Capsule::schema()->drop('product_types');
    }
}
