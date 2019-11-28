<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccessoriesPacketsListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accessories_packets_lists', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name', 255);
            $table->string('image', 255);
            $table->string('thumb', 255);
            $table->text('description');
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
        Schema::dropIfExists('accessories_packets_lists');
    }
}
