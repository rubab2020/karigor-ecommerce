<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();

            $table->bigInteger('vendor_id')->unsigned()->index();
            $table->foreign('vendor_id')->references('id')->on('vendors')->onDelete('cascade');
            
            $table->string('sku');
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('image_bg');
            $table->string('image_sm');
            $table->decimal('price', 10, 2);
            $table->decimal('sale_price', 10, 2);
            $table->date('sale_price_from')->nullable();
            $table->date('sale_price_to')->nullable();
            $table->integer('stock_quantity');
            $table->integer('low_stock_threshold')->nullable();
            $table->decimal('foo', 10, 2)('shipping_weight')->nullable();
            $table->string('purchase_note')->nullable();
            $table->softDeletes();
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
