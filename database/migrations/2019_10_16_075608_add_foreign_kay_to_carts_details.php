<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKayToCartsDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('carts_details', function (Blueprint $table) {
            $table->foreign('id_cart')
                ->references('id_cart')->on('carts')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::table('carts_details', function (Blueprint $table) {
            $table->foreign('id_product')
                ->references('id_product')
                ->on('products')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }
}
