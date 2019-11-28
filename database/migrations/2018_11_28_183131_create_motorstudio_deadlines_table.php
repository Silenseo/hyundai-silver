<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMotorstudioDeadlinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('motorstudio_deadlines', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->timestamp('closed_from')->nullable();
            $table->timestamp('closed_to')->nullable();
            $table->timestamp('show_from')->nullable();
            $table->timestamp('show_to')->nullable();
            $table->string('reason')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('motorstudio_deadlines');
    }
}
