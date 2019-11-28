<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSEOsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_e_os', function (Blueprint $table) {
            $table->increments('id');

            $table->string('url', 255);
            $table->string('meta_title', 255);
            $table->string('meta_keywords', 255);
            $table->string('meta_description', 255);
            $table->string('og_title', 255);

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
        Schema::dropIfExists('s_e_os');
    }
}
