<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTableCarts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->increments('id_cart');
            $table->dateTime('create_date');
            $table->dateTime('update_date');
            $table->unsignedInteger('id_customer');
            $table->enum('currency', ['USD', 'PLN', 'EUR']);
            $table->unsignedInteger('netto');
            $table->unsignedInteger('average');
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carts');
    }
}
