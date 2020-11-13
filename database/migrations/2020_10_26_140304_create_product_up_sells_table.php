<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductUpSellsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_up_sells', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('parent_id')->unsigned()->index();
            $table->foreign('parent_id')->references('id')->on('products')->onDelete('cascade');
            $table->bigInteger('child_id')->unsigned()->index();
            $table->foreign('child_id')->references('id')->on('products')->onDelete('cascade');
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
        Schema::dropIfExists('product_up_sells');
    }
}
