<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*

	11	service_API_field	text	utf8_general_ci		No	None			 Change Change	 Drop Drop
More More

        */
        Schema::create('cars', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_text', 255);
            $table->string('name', 255);
            $table->string('image', 255);
            $table->integer('price_min');
            $table->string('ga_modelcode', 255);

            $table->tinyInteger('menu_row');
            $table->tinyInteger('menu_column');

            $table->boolean('is_promo');
            $table->boolean('visible');

            $table->integer('conf_car_id');
            $table->integer('conf_id');

            $table->string('siebel_code', 255);

            $table->string('name_menu_rus', 255);
            $table->string('name_menu_en', 255);

            $table->string('img_left_mp', 255);
            $table->string('img_right_mp', 255);
            $table->string('img_beauty_mp', 255);

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
        Schema::dropIfExists('cars');
    }
}
