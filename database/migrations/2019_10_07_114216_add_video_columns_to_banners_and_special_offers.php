<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVideoColumnsToBannersAndSpecialOffers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('banners', function($table)
        {
            $table->string('video_desktop')->nullable();
            $table->string('video_mobile')->nullable();
        });

        Schema::table('special_offers', function($table)
        {
            $table->string('video_desktop')->nullable();
            $table->string('video_mobile')->nullable();
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
        Schema::table('special_offers', function($table)
        {
            $table->dropColumn('video_mobile');
            $table->dropColumn('video_desktop');
        });

        Schema::table('banners', function($table)
        {
            $table->dropColumn('video_mobile');
            $table->dropColumn('video_desktop');
        });
    }
}
