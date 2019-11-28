<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitiesRegionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities_regions', function (Blueprint $table) {
            $table->increments('id');

            $table->double('longitude');
            $table->double('latitude');

            $table->float('zoom');
            $table->float('order');

            $table->string('name', 255);
            $table->string('name_en', 255);
            $table->string('name_fi', 255);
            $table->string('name_de', 255);

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
        Schema::dropIfExists('cities_regions');
    }
}
