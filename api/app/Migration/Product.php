<?php

namespace app\Migration;

use Illuminate\Database\Capsule\Manager as Capsule;

class Product
{
    public function up()
    {
        Capsule::schema()->create('products', function ($table) {
            $table->increments('id');
            $table->integer('id_type')->unsigned();
            $table->foreign('id_type')->references('id')->on('product_types');
            $table->string('description');
            $table-> double('price', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Capsule::schema()->drop('products');
    }
}