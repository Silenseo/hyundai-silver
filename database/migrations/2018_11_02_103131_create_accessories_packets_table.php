<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccessoriesPacketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accessories_packets', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('packetlist_id')->references('id')->on('accessories_packets_lists');

            $table->string('name', 255);
            $table->integer('price');
            $table->integer('old_price');
            $table->string('products', 255);

            $table->integer('order');
            $table->boolean('visible');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accessories_packets');
    }
}
