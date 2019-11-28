<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDealersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dealers', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name', 255);
            $table->string('address', 255);
            $table->string('maps', 255);
            $table->string('phone', 255);
            $table->string('email', 255);
            $table->string('code', 255);
            $table->string('rc_code', 255);
            $table->string('site', 255);
            $table->double('latitude');
            $table->double('longitude');

            $table->boolean('visible');

            $table->string('zyngaya', 255);

            $table->integer('city_id')->references('id')->on('cities');

            $table->boolean('special');
            $table->boolean('wa');
            $table->boolean('hidden');
            $table->boolean('rating');

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
        Schema::dropIfExists('dealers');
    }
}
