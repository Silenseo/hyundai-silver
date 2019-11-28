<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMotorstudioEventRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('motorstudio_event_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('title');
            $table->string('description');
            $table->string('date');
            $table->string('time');
            $table->integer('members');
            $table->integer('guests');
            // $table->string('timing');
            $table->boolean('catering');
            $table->string('fio');
            $table->string('email');
            $table->string('tel');
            $table->string('about');
            $table->string('file')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('motorstudio_event_requests');
    }
}
