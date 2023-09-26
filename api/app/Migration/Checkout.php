<?php

namespace app\Migration;

use Illuminate\Database\Capsule\Manager as Capsule;

class Checkout
{
    public function up()
    {
        Capsule::schema()->create('checkouts', function ($table) {
            $table->increments('id');
            $table->integer('id_product')->unsigned();
            $table->integer('id_user');
            $table->foreign('id_product')->references('id')->on('products');
            $table-> double('amount', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Capsule::schema()->drop('checkouts');
    }
}