<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateSpecialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('special_offers', function (Blueprint $table) {
            $table->string('blue_row1_text')->nullable()->change();
            $table->string('blue_row2_text')->nullable()->change();
            $table->string('blue_row3_text')->nullable()->change();
            $table->text('disclaimer')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
