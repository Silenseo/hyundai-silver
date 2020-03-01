<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOgColumnsToSEOs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('s_e_os', function($table)
        {
            $table->string('og_image', 255)->nullable();
            $table->string('og_description', 255)->nullable();
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
        Schema::table('s_e_os', function($table)
        {
            $table->dropColumn('og_description');
            $table->dropColumn('og_image');
        });
    }
}
