<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cart_id')->index()->unsigned()->comment('CART ID');
            $table->foreign('cart_id')->on('carts')->references('id')->onDelete('cascade');
            $table->bigInteger('product_id')->index()->unsigned()->comment('PRODUCT ID');
            $table->foreign('product_id')->on('products')->references('id');
            $table->bigInteger('vendor_id')->unsigned()->comment('VENDOR ID');
            $table->foreign('vendor_id')->on('vendors')->references('id');
            $table->decimal('base_price', 10, 2)->comment('BASE PRICE');
            $table->decimal('final_price', 10, 2)->comment('FINAL PRICE WITH DISCOUNT MULTIPLIED WITH QTY');
            $table->integer('qty')->default(1)->comment('QTY');
            $table->decimal('weight', 10, 2)->nullable()->comment('WEIGHT');
            $table->decimal('discount_percent', 10, 2)->default(0)->comment('DISCOUNT PERCENTAGE');
            $table->decimal('discount_amount', 10, 2)->default(0)->comment('DISCOUNT AMOUNT');
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
        Schema::dropIfExists('cart_items');
    }
}
