<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrandcollectionProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brandcollection_products', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
            $table->string('article');
            $table->integer('category_id')->unsigned();
            $table->integer('tag_id')->unsigned();
            $table->integer('price');
            $table->string('image');
            $table->text('description');
            $table->text('size');
            $table->text('material');
            $table->text('specifications');
            $table->integer('sort');
            $table->boolean('is_active');
            $table->boolean('is_new');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('brandcollection_products');
    }
}
