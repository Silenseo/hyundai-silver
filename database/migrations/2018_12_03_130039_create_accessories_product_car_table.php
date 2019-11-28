<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccessoriesProductCarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accessories_product_car', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('accessories_product_id')->unsigned();
            $table->integer('car_id')->unsigned();
            $table->integer('price');
            $table->foreign('accessories_product_id')->references('id')->on('accessories_products');
            $table->foreign('car_id')->references('id')->on('cars');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accessories_product_car');
    }
}
