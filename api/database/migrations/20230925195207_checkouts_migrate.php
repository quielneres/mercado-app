<?php

declare(strict_types=1);

use app\Migration\Migration;
use Illuminate\Database\Capsule\Manager as Capsule;

final class CheckoutsMigrate extends Migration
{
    public function up()
    {
        Capsule::schema()->create('checkouts', function ($table) {
            $table->increments('id');
            $table->integer('id_user')->unsigned();
            $table->foreign('id_user')->references('id')->on('users');
            $table->text('items');
            $table->double('totalAmount', 8, 2);
            $table->double('taxValue', 8, 2);
            $table->double('itemsValue', 8, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Capsule::schema()->drop('checkouts');
    }
}
