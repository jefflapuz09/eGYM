<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deliveries', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('id',50)->primary();
            $table->integer('supplierId')->unsigned();
            $table->foreign('supplierId')->references('id')->on('suppliers');
            $table->date('dateMake');
            $table->boolean('isActive')->default(1);
            $table->boolean('isReceived')->default(0);
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
        Schema::dropIfExists('deliveries');
    }
}
