<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name', 255);
            $table->string('title', 255);
            $table->string('subtitle', 255);
            $table->string('image', 255);
            $table->string('image_mobile', 255);
            $table->string('image_text', 255);

            $table->boolean('blue_show');

            $table->string('blue_row1', 255);
            $table->string('blue_row2', 255);
            $table->string('blue_row3', 255);

            $table->tinyInteger('font_color');
            $table->tinyInteger('row1_type');
            $table->tinyInteger('row2_type');
            $table->tinyInteger('row3_type');

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
        Schema::dropIfExists('banners');
    }
}
