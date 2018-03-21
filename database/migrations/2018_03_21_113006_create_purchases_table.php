<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('id',50)->primary();
            $table->integer('supplierId')->unsigned();
            $table->foreign('supplierId')->references('id')->on('suppliers');
            $table->date('dateMake');
            $table->boolean('isActive')->default(1);
            $table->boolean('isFinalize');
            $table->boolean('isDelivered');
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
        Schema::dropIfExists('purchases');
    }
}
