<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableAccNullValues extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accessories_categories', function (Blueprint $table) {
            $table->string('subtitle')->nullable()->change();
            $table->string('image')->nullable()->change();
            
            $table->integer('order')->nullable()->change();
        });

        Schema::table('accessories_products', function (Blueprint $table) {
            $table->string('article')->nullable()->change();
            $table->string('image')->nullable()->change();

            $table->text('specs')->nullable()->change();
            $table->text('description')->nullable()->change();

            $table->integer('price')->nullable()->change();
            
            $table->integer('order')->nullable()->change();
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
