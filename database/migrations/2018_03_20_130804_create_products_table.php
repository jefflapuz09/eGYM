<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->double('price', 8, 2);
            $table->integer('typeId')->unsigned();
            $table->foreign('typeId')->references('id')->on('product_types');
            $table->integer('brandId')->unsigned();
            $table->foreign('brandId')->references('id')->on('product_brands');
            $table->integer('variantId')->unsigned();
            $table->foreign('variantId')->references('id')->on('product_variants');
            $table->integer('reorder');
            $table->text('description')->nullable();
            $table->boolean('isActive')->default(1);
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
        Schema::dropIfExists('products');
    }
}
