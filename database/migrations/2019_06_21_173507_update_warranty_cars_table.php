<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateWarrantyCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('warranty_cars', function (Blueprint $table) {
            $table->integer('sort')->default(100);
            $table->boolean('is_active')->default(1);
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
        Schema::table('warranty_cars', function (Blueprint $table) {
            $table->dropColumn('is_active');
            $table->dropColumn('sort');
       });
    }
}
