<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccessoriesProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
        2	category_id	int(11)			No	None			 Change Change	 Drop Drop
More More
	3	name	varchar(255)	utf8_general_ci		No	None			 Change Change	 Drop Drop
More More
	4	article	varchar(255)	utf8_general_ci		No	None			 Change Change	 Drop Drop
More More
	5	price	int(11)			No	None			 Change Change	 Drop Drop
More More
	6	image	varchar(255)	utf8_general_ci		No	None			 Change Change	 Drop Drop
More More
	7	specs	text	utf8_general_ci		No	None			 Change Change	 Drop Drop
More More
	8	description	text	utf8_general_ci		No	None			 Change Change	 Drop Drop
More More
	9	order	int(11)			No	50			 Change Change	 Drop Drop
More More
	10	visible	int(11)
        */
        Schema::create('accessories_products', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('category_id')->references('id')->on('accessories_categories');

            $table->string('name', 255);
            $table->string('article', 255);
            $table->integer('price');

            $table->string('image', 255);

            $table->text('specs');
            $table->text('description');
            $table->integer('order');
            $table->boolean('visible');

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
        Schema::dropIfExists('accessories_products');
    }
}
