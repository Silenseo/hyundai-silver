<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMotorstudioEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('motorstudio_events', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name', 255);
            $table->string('name_en', 255);
            $table->string('calendar_name', 255);
            $table->string('calendar_name_en', 255);

            $table->integer('date_start');
            $table->integer('date_end');

            $table->string('preview_picture', 255);
            $table->string('detail_picture', 255);

            $table->text('text');
            $table->text('text_en');

            $table->integer('max_reg');

            $table->boolean('is_promo');
            $table->boolean('available');
            $table->boolean('repair');
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
        Schema::dropIfExists('motorstudio_events');
    }
}
