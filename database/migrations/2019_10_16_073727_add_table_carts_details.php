<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTableCartsDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts_details', function (Blueprint $table) {
            $table->unsignedInteger('id_cart');
            $table->unsignedInteger('id_product');
            $table->increments('id_cart_detail');
            $table->enum('currency', ['USD', 'PLN', 'EUR']);
            $table->unsignedInteger('quantity');
            $table->string('name', 200);
            $table->unsignedInteger('netto');
            $table->unsignedInteger('vat_rates');
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
        Schema::dropIfExists('carts_details');
    }
}
