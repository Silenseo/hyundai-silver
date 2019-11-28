<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMotorstudioRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('motorstudio_requests', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('event_id')->references('id')->on('motorstudio_events');

            $table->integer('date');

            $table->string('city', 255);
            $table->string('name', 255);
            $table->string('sirname', 255);
            $table->string('email', 255);
            $table->string('phone', 255);
            $table->string('age', 255);

            $table->text('comment');

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
        Schema::dropIfExists('motorstudio_requests');
    }
}
