<?php

namespace app\Migration;

use Illuminate\Database\Capsule\Manager as Capsule;

class ProductType
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