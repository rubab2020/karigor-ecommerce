<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_active')->default(true)->comment('IS IN ACTIVE ORDER');
            $table->bigInteger('user_id')->unsigned()->index()->nullable()->comment('USER ID');
            $table->foreign('user_id')->on('users')->references('id')->onDelete('cascade');
            $table->boolean('customer_is_guest')->default(false)->comment('FOR GUEST OR NOT');
            $table->integer('items_count')->default(0)->comment('TOTAL COUNT OF DISTINCT PRODUCTS');
            $table->integer('items_qty')->default(0)->comment('TOTAL COUNT OF PRODUCT QTY');
            $table->decimal('items_weight', 10, 2)->default(0)->comment('TOTAL WEIGHT OF ALL PRODUCTS');
            $table->decimal('grand_total', 10, 2)->nullable()->comment('GRAND TOTAL');
            $table->decimal('subtotal', 10, 2)->nullable()->comment('SUBTOTAL WITHOUT DISCOUNT');
            $table->decimal('subtotal_with_discount', 10, 2)->nullable()->comment('SUBTOTAL_WITH_DISCOUNT');
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
        Schema::dropIfExists('carts');
    }
}
