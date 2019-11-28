<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecialOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('special_offers', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
            $table->string('url');
            $table->integer('type');
            $table->integer('label_id')->unsigned();
            $table->text('text');
            $table->string('image_preview')->nullable();
            $table->string('image_world')->nullable();
            $table->string('banner')->nullable();
            $table->string('banner_title')->nullable();
            $table->string('banner_subtitle')->nullable();
            $table->boolean('blue_show');
            $table->integer('blue_row1_type');
            $table->integer('blue_row2_type');
            $table->integer('blue_row3_type');
            $table->string('blue_row1_text');
            $table->string('blue_row2_text');
            $table->string('blue_row3_text');
            $table->text('disclaimer');
            $table->integer('button_type');
            $table->boolean('is_active');
            $table->integer('sort');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('special_offers');
    }
}
