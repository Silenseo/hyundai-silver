<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableNullValues extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->string('siebel_code')->nullable()->change();
            $table->string('name_menu_rus')->nullable()->change();
            $table->string('name_menu_en')->nullable()->change();
            $table->string('img_left_mp')->nullable()->change();
            $table->string('img_right_mp')->nullable()->change();
            $table->string('img_beauty_mp')->nullable()->change();
            $table->string('image')->nullable()->change();
            $table->string('id_text')->nullable()->change();

            $table->integer('price_min')->nullable()->change();
            $table->integer('conf_car_id')->nullable()->change();
            $table->integer('conf_id')->nullable()->change();

            $table->integer('menu_row')->nullable()->change();
            $table->integer('menu_column')->nullable()->change();
        });

        Schema::table('banners', function (Blueprint $table) {
            $table->string('title')->nullable()->change();
            $table->string('subtitle')->nullable()->change();
            $table->string('image')->nullable()->change();
            $table->string('image_mobile')->nullable()->change();
            $table->string('image_text')->nullable()->change();
            $table->string('blue_row1')->nullable()->change();
            $table->string('blue_row2')->nullable()->change();
            $table->string('blue_row3')->nullable()->change();

            $table->integer('font_color')->nullable()->change();
            $table->integer('row1_type')->nullable()->change();
            $table->integer('row2_type')->nullable()->change();
            $table->integer('row3_type')->nullable()->change();

            $table->integer('order')->nullable()->change();
        });

        Schema::table('placeholders', function (Blueprint $table) {
            $table->string('type')->nullable()->change();
            $table->text('text')->nullable()->change();
        });

        Schema::table('s_e_os', function (Blueprint $table) {
            $table->string('meta_title', 255)->nullable()->change();
            $table->string('meta_keywords', 255)->nullable()->change();
            $table->string('meta_description', 255)->nullable()->change();
            $table->string('og_title', 255)->nullable()->change();
        });

        Schema::table('cities_regions', function (Blueprint $table) {
            $table->float('longitude')->nullable()->change();
            $table->float('latitude')->nullable()->change();

            $table->float('zoom')->nullable()->change();
            $table->float('order')->nullable()->change();

            $table->string('name_en', 255)->nullable()->change();
            $table->string('name_fi', 255)->nullable()->change();
            $table->string('name_de', 255)->nullable()->change();
        });

        Schema::table('dealers', function (Blueprint $table) {
            $table->string('address', 255)->nullable()->change();
            $table->string('phone', 255)->nullable()->change();
            $table->string('email', 255)->nullable()->change();
            $table->string('code', 255)->nullable()->change();
            $table->string('rc_code', 255)->nullable()->change();
            $table->string('site', 255)->nullable()->change();
            $table->float('latitude')->nullable()->change();
            $table->float('longitude')->nullable()->change();

            $table->string('zyngaya', 255)->nullable()->change();
        });

        Schema::table('news', function (Blueprint $table) {
            $table->integer('date')->nullable()->change();

            $table->string('url', 255)->nullable()->change();
            $table->text('text')->nullable()->change();

            $table->string('img', 255)->nullable()->change();

            $table->text('comment')->nullable()->change();

            $table->string('meta_title', 255)->nullable()->change();
            $table->string('meta_keywords', 255)->nullable()->change();
            $table->string('meta_description', 255)->nullable()->change();
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
