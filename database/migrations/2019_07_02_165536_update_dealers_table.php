<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateDealersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('dealers', function (Blueprint $table) {
            $table->integer('credit_id')->nullable();
            $table->boolean('i30n')->default(0);
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
        Schema::table('dealers', function (Blueprint $table) {
            $table->dropColumn('i30n');
            $table->dropColumn('credit_id');
       });
    }
}
