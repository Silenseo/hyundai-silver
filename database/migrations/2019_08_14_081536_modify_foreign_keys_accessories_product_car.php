<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyForeignKeysAccessoriesProductCar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('accessories_product_car', function($table)
        {
            $table->dropForeign('accessories_product_car_accessories_product_id_foreign');
            $table->foreign('accessories_product_id')->references('id')->on('accessories_products')->onDelete('cascade')->onUpdate('cascade');
            $table->dropForeign('accessories_product_car_car_id_foreign');
            $table->foreign('car_id')->references('id')->on('cars')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
